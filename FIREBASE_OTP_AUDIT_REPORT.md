# Firebase Phone Authentication (SMS OTP) — Read-Only Audit Report

**Project:** Wngez (`wngez.com`) · **Firebase project:** `wngez-cb47c`
**Repository under audit:** `website/` (Next.js marketplace frontend)
**Audit date:** 2026-10-12
**Mode:** READ-ONLY. No source file, dependency, Firebase setting, database, deployment or SMS request was changed. The only file written is this report.
**Redaction:** API keys, tokens, phone numbers and credentials are never printed. Where a key had to be referenced, its SHA-256 prefix and length are used instead.

---

## A. Executive Summary

The frontend uses the **official Firebase JS SDK** (`firebase@11.9.1`, `@firebase/auth@1.10.7`) and the phone-OTP code path is the standard modular API (`RecaptchaVerifier` + `signInWithPhoneNumber` + `ConfirmationResult.confirm`). There is **no custom Identity Toolkit client** in the repository.

**The failing HTTP request is authentic SDK traffic, not custom code.** The exact combination reported in production
(`captchaResponse: "NO_RECAPTCHA"`, `recaptchaVersion: "RECAPTCHA_ENTERPRISE"`, `clientType: "CLIENT_TYPE_WEB"`, plus a `recaptchaToken`) is produced by `injectRecaptchaFields(..., isFakeToken = true)` inside `@firebase/auth` — the SDK's **reCAPTCHA v2 fallback** path. That means the browser could **not** load a reCAPTCHA Enterprise configuration (no `recaptchaKey`) and fell back to legacy v2, while still labelling the request as Enterprise.

Two facts dominate the investigation:

1. **The repository's own Firebase API key resolves to the correct project *today* and *does* return an Enterprise key.** A read-only probe of the public configuration endpoint with the key from `website/.env` returned:
   - `GET /v1/projects` → `200`, authorized domains `["localhost", "wngez-cb47c.firebaseapp.com", "wngez-cb47c.web.app", "wngez.com"]` (correct project);
   - `GET /v2/recaptchaConfig` → `200`, `PHONE_PROVIDER: AUDIT`, **`recaptchaKey` present**, `useSmsTollFraudProtection: true`;
   - `GET /v1/recaptchaParams` → `200` with a v2 site key.
   This **contradicts** the production capture (`ENFORCEMENT_STATE_UNSPECIFIED`, no `recaptchaKey`). The most economical explanation is that **the deployed client that produced the failing request was not using this configuration** (stale build, different environment, or a different API key), or that the configuration was changed after the failure was captured.

2. **Firebase test numbers bypass the reCAPTCHA assessment server-side, real numbers do not.** A project/API-key mismatch, a wrong API key at runtime, or a rejected reCAPTCHA assessment therefore produces exactly the observed asymmetry: test numbers succeed, real numbers return `INVALID_APP_CREDENTIAL`.

The SDK itself treats `auth/invalid-app-credential` as a **captcha-token failure**: in `AUDIT` mode it reacts to that exact code by retrying the phone flow with a v2 token (`@firebase/auth` lines 3607–3636). That is strong evidence the error is a reCAPTCHA-credential rejection, not an SMS-routing or phone-number problem.

**Secondary confirmed defects** (not proven to be the production trigger, but they can corrupt the verifier lifecycle and mask the real error): three DOM elements share `id="recaptcha-container"`, a single `window.recaptchaVerifier` is shared across three independently mounted modals, the container is `display:none`, and a `null` verifier can be passed to `signInWithPhoneNumber` without a guard.

**Verdict:** the security-relevant, highest-probability root cause is a **runtime Firebase/reCAPTCHA configuration mismatch between the deployed client and the project console** — not an error in the phone-auth code path itself. Sections H–K give the exact verification order to prove or eliminate each candidate without sending an SMS.

---

## B. Project Architecture

| Aspect | Finding | Evidence |
|---|---|---|
| Framework | Next.js 16 (App Router) + React 19 | `website/package.json` (`next ^16.3.0`, `react 19.2.4`) |
| Firebase SDK | `firebase@11.9.1` (modular) → `@firebase/auth@1.10.7` | `website/package.json:51`, `node_modules/@firebase/auth/package.json` |
| Firebase namespaces | **Two**: `firebase/compat/app` *and* modular `firebase/app` in the same module | `website/lib/firebase.js:2` and `:8` |
| Auth entry points | Login modal → `LoginWithMobileForm`; Register modal → `RegisterWithMobileForm`; OTP confirm → `OtpScreen`; delete-account verification → `DeleteAccountVerifyOtpModal` | `features/auth/**` |
| Backend integration | After `confirmationResult.confirm()`, the client posts the Firebase UID to the Laravel API (`user-signup`) | `features/auth/OtpScreen.jsx:96-134` |
| OTP provider switch | `otp_service_provider` from system settings selects `firebase` vs `twilio`/`2factor` | `store/slices/settingSlice.js:69-72`; `OtpScreen.jsx:147-155` |
| Config delivery | All Firebase values are **build-time** `NEXT_PUBLIC_*` variables, inlined by Next at build | `website/.env:16-22`, `lib/firebase.js:15-23` |
| Emulator | None found (no `connectAuthEmulator`) | repo-wide grep |
| Testing bypass | **No** `appVerificationDisabledForTesting` anywhere | repo-wide grep (0 hits) |

Environment-dependent behaviour: because `NEXT_PUBLIC_*` values are inlined at build time, a rebuild is mandatory after any `.env` change. A stale production artifact will silently keep an old project, API key or auth domain.

---

## C. Firebase Initialization Map

**Primary module — `website/lib/firebase.js`**

| Line | Code | Note |
|---|---|---|
| 15–22 | `const firebaseConfig = { apiKey: process.env.NEXT_PUBLIC_API_KEY, authDomain, projectId, storageBucket, messagingSenderId, appId, measurementId }` | Single source for the modular instance |
| 31–33 | `if (!firebase.apps.length) firebase.initializeApp(firebaseConfig)` | **compat** initializer |
| 35 | `export const app = !getApps().length ? initializeApp(firebaseConfig) : getApp()` | **modular** initializer |
| 36 | `export const authentication = getAuth(app)` | Modular Auth singleton |

Observations:

- The compat and modular registries share the same default app, so this does **not** create two apps, but it does ship the compat SDK (`firebase/compat/app`) in addition to the modular one — extra bundle weight and a second initialisation path that must be kept consistent. No duplicate-app exception is expected because of the `getApps()` guard.
- `getAuth()` is also called *without* the app argument in feature code (`LoginModal.jsx:60`, `RegisterWithMobileForm.jsx:38`). That resolves to the same default app, so it is functionally equivalent — but it is an implicit dependency on module import order.
- **No `initializeAuth()`**, no persistence overrides, no emulator, no `appVerificationDisabledForTesting`.

**Secondary config source — `website/public/firebase-messaging-sw.js`**

| Line | Content |
|---|---|
| 5–12 | A second, **hard-coded** `firebaseConfig` (apiKey, authDomain `wngez-cb47c.firebaseapp.com`, projectId `wngez-cb47c`, sender `937937183745`, appId `1:937937183745:web:…`) |
| 15 | `firebase?.initializeApp(firebaseConfig)` |

This file is served to the browser as a service worker and is itself cached by browsers. It is a second source of truth for the Firebase project and can drift from `.env` after a project/API-key rotation. (FCM only — it does not affect OTP, but it is part of the configuration map.)

**Build-time configuration probe (read-only, no secrets printed)**

| Probe | Result |
|---|---|
| `.env` key → SHA-256 prefix `02c76460af`, length 39 | valid-shape Firebase web key |
| `GET /v1/projects?key=<repo key>` | `200`; authorized domains `localhost`, `wngez-cb47c.firebaseapp.com`, `wngez-cb47c.web.app`, `wngez.com` → **the key belongs to the intended project** |
| `GET /v2/recaptchaConfig?key=<repo key>` | `200`; `PHONE_PROVIDER: AUDIT`; **`recaptchaKey` present**; `useSmsTollFraudProtection: true` |
| `GET /v1/recaptchaParams?key=<repo key>` | `200`; v2 site key returned (length 40) |

> These probes hit only public, read-only configuration endpoints. No SMS, no sign-in, no writes.

---

## D. OTP Request Flow (traced end-to-end)

### D.1 Registration with mobile — `features/auth/register/RegisterWithMobileForm.jsx`

| Step | Line | Behaviour |
|---|---|---|
| Auth instance | 38 | `const auth = getAuth()` (default app) |
| Input validation | 170–185 | `libphonenumber-js` `isValidPhoneNumber()` |
| Provider branch | ~200 | Firebase path when `otp_service_provider` is not `twilio`/`2factor` |
| Verifier creation | **72–96** | `generateRecaptcha()`: reuses `window.recaptchaVerifier` if not destroyed; otherwise `document.getElementById("recaptcha-container")`, clears it, `new RecaptchaVerifier(auth, container, { size: "invisible" })` |
| OTP request | **145–168** | `signInWithPhoneNumber(auth, PhoneNumber, appVerifier)`; stores `ConfirmationResult`; switches UI to the OTP step |
| Cleanup | **98–117** | `useEffect` unmount → `recaptchaClear()` → `verifier.clear()`, clears `window.recaptchaVerifier` and the container |
| Error surface | 161–167 | `console.log(error)` then `handleFirebaseAuthError(error.code, t)` |

### D.2 Login with mobile — `features/auth/login/LoginModal.jsx`

| Step | Line | Behaviour |
|---|---|---|
| Auth instance | 60 | `const auth = getAuth()` |
| Forgot-password / phone login | 226–256 | Provider branch identical to registration |
| Verifier creation | **106–130** | Same global-verifier pattern |
| Cleanup | **132–151** | Same unmount cleanup |
| OTP request | **243–249** | `signInWithPhoneNumber(auth, PhoneNumber, appVerifier)` |
| Container | **512** | `<div id="recaptcha-container" style={{ display: "none" }} />` |

### D.3 OTP confirmation — `features/auth/OtpScreen.jsx`

| Step | Line | Behaviour |
|---|---|---|
| Confirm | **96–99** | `confirmationResult.confirm(otp)` → Firebase user |
| Backend sync | 105–124 | `userSignUpApi.userSignup({ mobile, firebase_id, … })` |
| Resend | **172–186** | `generateRecaptcha()` again + `signInWithPhoneNumber(request)` → replaces `confirmationResult` |
| Error surface | 130–134 | `handleFirebaseAuthError(error?.code, t)` |

### D.4 Delete-account verification — `features/auth/DeleteAccountVerifyOtpModal.jsx`

| Step | Line | Behaviour |
|---|---|---|
| Verifier | **74–96** | Same global-verifier pattern |
| OTP request | **126–130**, **171–175** | `signInWithPhoneNumber(auth, PhoneNumber, appVerifier)` |
| Confirm | 146 | `confirmationResult.confirm(otp)` |
| Container | **247** | `<div id="recaptcha-container" style={{ display: "none" }} />` |

### D.5 Error decoding — `lib/form.js`

| Line | Content |
|---|---|
| 158 | `"auth/invalid-app-credential": t("invalidAppCredential")` |
| 244 | `handleFirebaseAuthError(errorCode, t)` — maps known codes to translated toasts |

The user-visible message for `INVALID_APP_CREDENTIAL` is therefore a generic translated string; the raw Firebase code is only written to the console (`console.log(error)`), which is why the failure looks opaque in the UI.

### D.6 Request-shape provenance (SDK source, `node_modules/@firebase/auth/dist/esm2017/index-*.js`)

| Lines | Function | What it proves |
|---|---|---|
| 8876–8890 | `_verifyPhoneNumber` | Lazily calls `_initializeRecaptchaConfig(auth)`; **if it throws**, logs “Failed to initialize reCAPTCHA Enterprise config. Triggering the reCAPTCHA v2 verification.” and continues with v2 |
| 1069–1090 | `RecaptchaConfig` constructor | **Throws `recaptchaKey undefined`** when the response has no key — i.e. the capture with no `recaptchaKey` forces the v2 fallback |
| 3526–3579 | `injectRecaptchaFields` | With `isFakeToken=true` sets `captchaResponse = "NO_RECAPTCHA"` and adds `clientType: CLIENT_TYPE_WEB`, `recaptchaVersion: RECAPTCHA_ENTERPRISE` |
| 3586–3640 | `handleRecaptchaFlow` (PHONE_PROVIDER) | If the provider is not enabled in config → v2 flow directly. In `AUDIT` mode, a `missing-recaptcha-token` **or `invalid-app-credential`** error triggers the v2 retry |
| 9012–9040 | `injectRecaptchaV2Token` | Calls `verifier.verify()` (the app's `RecaptchaVerifier`) and injects the v2 `recaptchaToken` into the request |
| 8734–8736 | `RecaptchaVerifier.render` | v2 widget site key is fetched from `/v1/recaptchaParams` (Firebase-managed) |

**Conclusion:** the observed request is exactly the SDK's v2 fallback, and `INVALID_APP_CREDENTIAL` is the code the SDK itself associates with a failed captcha credential.

---

## E. reCAPTCHA Lifecycle and Enterprise Compatibility

### E.1 What the app does

- One invisible `RecaptchaVerifier` per attempt group, cached on `window.recaptchaVerifier`.
- Container is a **hidden** `<div id="recaptcha-container">` in three different modal components.
- Verifier is destroyed only on component **unmount** — not when the modal closes, not on provider change, not after a failed send.

### E.2 What the SDK expects

- v11 supports both reCAPTCHA v2 (`RecaptchaVerifier`) and Enterprise (`RecaptchaEnterpriseVerifier`), and **does not require** the app to call the optional `initializeRecaptchaConfig(auth)`; it self-initialises lazily. Calling it early would only reduce latency and **surface configuration errors earlier and visibly** — see the recommendation in J.
- For Enterprise, the site key comes exclusively from `GET /v2/recaptchaConfig` (`projects/<n>/keys/<sitekey>`). If absent, Enterprise is impossible and the SDK falls back to v2.
- The v2 path is *not* automatically invalid: a correctly configured project with a reachable managed v2 site key works indefinitely. That is why the current failure must be explained by configuration at the **runtime client**, not by the mere presence of the fallback.

### E.3 Lifecycle / DOM defects (confirmed by code)

| ID | Severity | Path | Function | Line | Evidence | Why it matters |
|---|---|---|---|---|---|---|
| E-1 | **High** (config-dependent) | `features/auth/login/LoginModal.jsx`, `features/auth/register/RegisterModal.jsx`, `features/auth/DeleteAccountVerifyOtpModal.jsx` | JSX | 512 / 344 / 247 | Three elements share `id="recaptcha-container"`; all three components are mounted unconditionally by `HomeHeader` (414, 422, 494) | `document.getElementById()` returns the **first** match in DOM order. During modal cross-fades (Radix `Presence` keeps the closing dialog mounted ~200 ms) the verifier can be rendered into the closing dialog’s container, which is then removed → verifier bound to a detached node → token generation can fail or return an unusable token |
| E-2 | **High** | same three files | `generateRecaptcha` | 72–96 / 106–130 / 74–96 | `window.recaptchaVerifier` is a **global** reused across all three modals, guarded only by `!destroyed` | A verifier created for modal A can be reused by modal B. If A’s container was removed, the widget is stale; `verify()` may produce an invalid/expired token |
| E-3 | **Medium** | same three files | JSX | same | Container is `style={{ display: "none" }}` | Invisible reCAPTCHA is designed for a hidden widget, but a `display:none` host prevents layout/render in some browsers; the documented pattern is an on-page empty div (or off-screen, not `display:none`) |
| E-4 | **Medium** | `RegisterWithMobileForm.jsx:72-96`, `LoginModal.jsx:106-130`, `DeleteAccountVerifyOtpModal.jsx:74-96` | `generateRecaptcha` returns `null` on failure | Same callers pass it straight into `signInWithPhoneNumber(...)` (148 / 244 / 126) | SDK asserts `verifier.type === 'recaptcha'` (`index.js:8902-8912`) and throws `auth/argument-error`; the UI then shows a misleading “argument error” instead of “captcha unavailable” |
| E-5 | **Low** | `LoginModal.jsx:512`, `RegisterModal.jsx:344` | container rendered inside `DialogContent` | Same | The container only exists while that dialog is mounted; `generateRecaptcha` is reachable before the dialog content mounts if the flow is triggered programmatically | `getElementById` returns `null` → null verifier (see E-4) |

### E.4 Is the Enterprise integration “supported”?

Yes at SDK level (`@firebase/auth` 1.10.7 implements `RecaptchaEnterpriseVerifier`). The app **does not** implement anything custom, so compatibility is entirely a matter of the backend config returned for the API key in use:

- key present + `AUDIT`/`ENFORCE` → SDK uses Enterprise first.
- key absent → SDK v2 fallback (observed in the production capture).
- Neither path can succeed if the token is generated for a site key/domain the backend does not accept.

### E.5 Conditions that produce `INVALID_APP_CREDENTIAL` (ranked by likelihood for this project)

1. The captcha token/assessment is not valid for the project of the **API key in the request** (kept from a different project, or site key not bound to the origin).
2. The API key has application restrictions (HTTP referrers) that do not include the **exact** origin (`www.wngez.com` vs `wngez.com`, preview domains).
3. The web app / authorized domain is registered under a **different Firebase app** than the one whose key is used.
4. A tenant or multi-app mismatch (not evidenced here).
5. A malformed/empty v2 token produced by a broken verifier (E-1/E-2/E-3).

---

## F. Test vs Real Number Behaviour

| Question | Answer | Evidence |
|---|---|---|
| Is `appVerificationDisabledForTesting` enabled? | **No** — zero occurrences in the repository | repo-wide grep |
| Is there any test-number branch in the client? | **No** | repo-wide grep |
| Why do test numbers succeed? | Firebase test numbers are recognised **server-side** and skip the reCAPTCHA assessment; the client sends the same request envelope | SDK flow + observed behaviour |
| Why do real numbers fail? | Real numbers require a valid reCAPTCHA credential bound to the project/origin; a wrong runtime key/config or a rejected token yields `INVALID_APP_CREDENTIAL` | SDK `handleRecaptchaFlow` treats this code as a captcha failure |
| Could a stale verifier explain it? | Possible but weaker: both test and real numbers use the same verifier; test numbers would also break at the client stage. Since they do not, the failure is **server-side validation of the captcha**, not token acquisition | E-1/E-2 remain secondary |

---

## G. Environment and Deployment Risks

| ID | Severity | Finding | Evidence |
|---|---|---|---|
| G-1 | **High** | `NEXT_PUBLIC_*` are inlined at build time; `.env` was modified **2026-10-12**, while the last local production build (`BUILD_ID`) is **2026-09-29** | `.next/BUILD_ID` mtime `2026-09-29T00:42Z`; `.env` mtime `2026-10-12T07:59Z` |
| G-2 | **High** | The local build artifacts **do not contain** any inlined Firebase API key or the project-id string → cannot prove which config the deployed bundle carries; likely a build produced with different/empty env values | scan of `.next/server` + `.next/static` (0 matches for the project id, 0 valid keys) — **NOT VERIFIED** for production |
| G-3 | **Medium** | At audit time `https://wngez.com/` returns a **WordPress/MyListing** page (WooCommerce, Elementor), not the Next.js marketplace; the only `AIza…` string is a Google-Maps token (`MyListing.MapConfig`). The Next.js app is therefore served from a different host/path than the domain asserted in the ticket | live fetch of `https://wngez.com/` |
| G-4 | **Medium** | Second hard-coded Firebase config in `public/firebase-messaging-sw.js` (lines 5–12); a cached service worker can survive a project/API-key change | file content |
| G-5 | **Low** | No CSP/`headers()` in `next.config.mjs`; no referrer/metadata policy that could block reCAPTCHA | `website/next.config.mjs` |
| G-6 | **Low** | No emulator or preview flag found; no `initializeAuth`; no duplicate `initializeApp` at runtime | greps |

---

## H. Ranked Root Cause Hypotheses

### H-1 — The runtime client is not using the audited Firebase configuration (stale build or wrong environment) — **Likely (strongest)**

| Field | Detail |
|---|---|
| Severity | **Critical** |
| File / component | build/deploy pipeline; `.env:16-22`; `lib/firebase.js:15-36` |
| Evidence | The production capture shows `recaptchaConfig` = `UNSPECIFIED` **without** `recaptchaKey`. The same endpoint, called with the repository key, currently returns `AUDIT` **with** a key. The SDK cannot produce `captchaResponse: NO_RECAPTCHA` when a key is present and the provider is enabled — it would send an Enterprise token instead. Therefore the failing client did not hold this configuration. |
| Why it matters | A stale/foreign key explains both halves of the symptom: no Enterprise key (→ v2 fallback) and `INVALID_APP_CREDENTIAL` (→ the v2 token is evaluated against a project/origin the key is not entitled to). Test numbers still pass because they bypass the assessment. |
| Remediation | Rebuild and redeploy the exact artifact after confirming the production environment variables; verify the runtime key fingerprint in the **deployed** bundle (hashed comparison, never by printing the key). |
| Verification | In the failing browser: `firebase.app().options.apiKey` (hash it), then read `GET /v2/recaptchaConfig` from DevTools Network and confirm it returns `AUDIT` + `recaptchaKey`. If it does not, the client config is wrong — stop and fix the build first. |

### H-2 — reCAPTCHA Enterprise key / origin binding rejects the assessment — **Likely**

| Field | Detail |
|---|---|
| Severity | **High** |
| File / component | Google Cloud reCAPTCHA key `projects/937937183745/keys/6LdW…` and Identity Platform PHONE_PROVIDER settings |
| Evidence | Fraud Defense console reports a web-platform key with `AUDIT`; the key currently returned by `recaptchaConfig` is score-based Enterprise. If its allowed domains do not include the exact serving origin, every assessment fails; in `AUDIT` the SDK then retries with a v2 token, and the v2 token can be rejected too. |
| Why it matters | No code change can fix this; it is a console configuration issue. |
| Remediation | In Google Cloud → reCAPTCHA Enterprise → key `6LdW…`: verify **Web** platform, add `wngez.com`, `www.wngez.com` and any preview/staging origins; verify the key belongs to project `937937183745`; ensure Identity Platform Fraud Defense applies the same key to **PHONE_PROVIDER**. |
| Verification | From the production origin, run a single `grecaptcha.enterprise.execute(siteKey, {action:'verify'})` in the console and exchange the token with a **test assessment** (no SMS). A rejected token confirms H-2. |

### H-3 — Verifier lifecycle / duplicate container IDs produce an unusable v2 token — **Confirmed defect, unproven trigger**

| Field | Detail |
|---|---|
| Severity | **High** (cumulative) |
| File / component | three modals (E-1, E-2), `display:none` container (E-3), null-verifier pass-through (E-4) |
| Evidence | Three `id="recaptcha-container"` elements; global `window.recaptchaVerifier`; cleanup only on unmount; no null guard before `signInWithPhoneNumber`. |
| Why it matters | Can yield expired/detached-widget tokens and misleading `auth/argument-error`; makes field diagnostics unreliable. |
| Remediation | One container with a unique id per modal (or a single app-level container); scope the verifier to the component (ref/state, not `window`); clear on dialog close; guard `if (!appVerifier) throw …`. |
| Verification | Open login → close → open register → send OTP; assert exactly one `#recaptcha-container` exists and `verifier.render()` completed (`verifier.widgetId !== null`) before `signInWithPhoneNumber`. |

### H-4 — API key application restrictions / referrer enforcement — **Not verified**

| Field | Detail |
|---|---|
| Severity | **High** if present |
| Evidence | Cannot be read from the repository. `INVALID_APP_CREDENTIAL` can accompany restricted keys; a blocked-referrer key normally surfaces as `API_KEY_HTTP_REFERRER_BLOCKED`, which is *not* what was reported — this lowers its probability. |
| Remediation | Google Cloud → APIs & Services → Credentials → the key used in production → Application restrictions = HTTP referrers, include `https://wngez.com/*` and `https://www.wngez.com/*`; API restrictions must include **Identity Toolkit API**. |
| Verification | Reproduce from the exact production origin and read the raw error code; compare with a key that has no restrictions in a staging project (no SMS needed — a `sendVerificationCode` with `test` captcha is sufficient only if it returns before SMS; otherwise use the token-assessment path). |

### H-5 — Wrong project / multi-app or tenant mismatch — **Not verified**

| Field | Detail |
|---|---|
| Severity | **Medium** |
| Evidence | The audited key resolves to the intended project (authorized domains match). No tenant id is used in the code. Only a runtime key from another project would reproduce this. |
| Verification | Compare the runtime key’s `/v1/projects` response with `wngez-cb47c` and the `appId`/sender id `937937183745`. |

---

## I. Exact Files and Lines Requiring Changes (code-side, for the remediation phase — **not applied**)

| # | File | Function / element | Line(s) | Change |
|---|---|---|---|---|
| 1 | `website/lib/firebase.js` | module init | 31–36 | Remove the compat `initializeApp`; keep a single modular init; add an explicit runtime assertion/log of the **projectId** (never the key) in development |
| 2 | `website/features/auth/login/LoginModal.jsx` | `generateRecaptcha` / container | 106–130, 512 | Unique container id, `ref`-based verifier instead of `window`, null guard, clear on dialog close |
| 3 | `website/features/auth/register/RegisterWithMobileForm.jsx` | `generateRecaptcha` / cleanup | 72–117 | Same as #2; remove `display:none`, use an off-screen but rendered container |
| 4 | `website/features/auth/register/RegisterModal.jsx` | container | 344 | Unique id (`register-recaptcha-container`) |
| 5 | `website/features/auth/DeleteAccountVerifyOtpModal.jsx` | `generateRecaptcha` / container | 74–96, 247 | Unique id (`delete-otp-recaptcha-container`) |
| 6 | `website/features/auth/OtpScreen.jsx` | `resendOtpWithFirebase` | 172–186 | Reuse the component-scoped verifier; surface a distinct “captcha unavailable” error |
| 7 | `website/features/auth/login/LoginModal.jsx` | `handleForgotPassword` | 226–256 | Guard `appVerifier === null` |
| 8 | `website/lib/form.js` | error map | 158, 244 | Log the raw Firebase code + `error.message` in dev; keep the translated toast in prod |
| 9 | `website/.env` / hosting env | config | 16–22 | Single source of truth; document that a rebuild is required after any change |
| 10 | `website/public/firebase-messaging-sw.js` | config | 5–12 | Generate from env at build time or document the manual sync (FCM-only) |

> No other file needs modification to diagnose or fix the reCAPTCHA configuration problem; items 1–10 are hardening, not the root cause.

---

## J. Safe Step-by-Step Remediation Plan (do not apply until H-1/H-2 are resolved)

1. **Freeze the variable:** capture, from the failing browser, a hashed fingerprint of `firebase.app().options.apiKey` and of `firebase.app().options.projectId`. Compare with `.env`. (No secret printed.)
2. **Prove the runtime config:** in DevTools Network, confirm the `POST /v2/recaptchaConfig` response used by that page contains `recaptchaKey` and `PHONE_PROVIDER: AUDIT|ENFORCE`. If not, rebuild/redeploy with the verified environment first (H-1).
3. **Prove the key binding:** Google Cloud → Credentials → verify HTTP-referrer restrictions and that Identity Toolkit API is allowed (H-4).
4. **Prove the Enterprise key:** reCAPTCHA Enterprise → key → Web platform domains include every serving origin (H-2).
5. **Call the optional API early:** add `initializeRecaptchaConfig(auth)` once after auth init so configuration failures surface as a clear error instead of a silent v2 fallback (code change, later).
6. **Harden the verifier lifecycle** (items 2–7 in section I).
7. **Add observability:** on `sendVerificationCode` failure, log `error.code`, `error.message` and whether a `recaptchaKey` was present — never the token or key.
8. **Only then** re-test with a real number, once, from production.

---

## K. Manual Firebase / Google Cloud Checklist (must be executed in the consoles — **NOT VERIFIED** here)

**Firebase / Identity Platform (project `wngez-cb47c`)**
- [ ] Authentication → Sign-in method → Phone **Enabled**.
- [ ] Authentication → Settings → **Authorized domains** contains `wngez.com`, `www.wngez.com`, the staging origin, `localhost`.
- [ ] Project settings → **Your apps** → Web app id equals `1:937937183745:web:a66ef076cea9f7d1204c00` and its `apiKey` equals the production key (compare by hash).
- [ ] Identity Platform → **Fraud Defense / reCAPTCHA** → PHONE_PROVIDER shows the intended mode and a key **for this project**.
- [ ] SMS region policy does not block the destination country (would normally surface as `invalid-phone-number`/quota errors, not `INVALID_APP_CREDENTIAL`).

**Google Cloud (`937937183745`)**
- [ ] APIs & Services → Enabled APIs: **Identity Toolkit API** and **reCAPTCHA Enterprise API**.
- [ ] Credentials → API key used by production: Application restrictions and API restrictions (H-4).
- [ ] reCAPTCHA Enterprise → key `projects/937937183745/keys/6LdW…`: platform **Web**, allowed domains include all origins (H-2).
- [ ] OAuth consent / project number sanity: sender id `937937183745`.

**Deployment**
- [ ] The host serving the marketplace frontend (not the WordPress page currently at `wngez.com/`) builds from the verified env and the build is newer than the last `.env` change.
- [ ] No CDN/service-worker cache serves an older JS bundle (`BUILD_ID` mismatch check).

---

## L. Verification and Regression Test Plan

**L.1 Configuration proof (no SMS)**
1. From the production origin, read the Network entry for `GET /v2/recaptchaConfig`: expect `200`, `recaptchaKey` present, `PHONE_PROVIDER` = `AUDIT` or `ENFORCE`.
2. In the console, `firebase.app().options.projectId` → `wngez-cb47c`; hash `apiKey` and match to `.env`.
3. `GET /v1/projects` with the runtime key → authorized domains include the exact serving host.

**L.2 Verifier lifecycle proof (no SMS)**
4. Open the login modal, trigger the phone step, then evaluate in the console: `document.querySelectorAll('#recaptcha-container').length === 1` and the SDK verifier has a non-null `widgetId`.
5. Close the modal and reopen the other one; assert the verifier is recreated and the container is attached (`document.body.contains(container)`).

**L.3 Positive flow (one real OTP, after configuration is proven)**
6. Send OTP once from production; expect `200` on `accounts:sendVerificationCode`.
7. Confirm the code; expect a Firebase user and a successful `user-signup` call.

**L.4 Regression matrix**
| Scenario | Expected |
|---|---|
| Test number | `200`, OTP screen shown |
| Real number, valid captcha | `200`, OTP screen shown |
| Real number, invalid captcha | a clear captcha error (not the generic `INVALID_APP_CREDENTIAL` toast) |
| Resend after 60 s | new `ConfirmationResult`, single verifier |
| Modal switch login ↔ register | one container, verifier rebuilt |
| Short viewport / mobile keyboard | no clipped modal, captcha still renders |

**L.5 Logging hygiene**
8. Ensure no token, API key or phone number is written to logs; keep only `error.code`, `error.message`, project id and a key fingerprint.

---

## Appendix — Evidence Log (read-only)

| Evidence | Result |
|---|---|
| `firebase` dependency | `11.9.1`; `@firebase/auth` `1.10.7` |
| `appVerificationDisabledForTesting` | 0 occurrences |
| `initializeRecaptchaConfig` in app code | 0 occurrences (SDK lazy-init only) |
| `#recaptcha-container` occurrences | 3 (Login, Register, Delete-account modals) |
| Modals mounted by `HomeHeader` | yes — lines 414, 422, 494 |
| `GET /v1/projects` with repo key | `200`, projects’ authorized domains include `wngez.com` |
| `GET /v2/recaptchaConfig` with repo key | `200`, `AUDIT`, `recaptchaKey` present, toll-fraud protection `true` |
| `GET /v1/recaptchaParams` with repo key | `200`, v2 site key present |
| Live `https://wngez.com/` | returns a WordPress/MyListing page, no Next.js assets |
| Local `.next` build age | `2026-09-29` vs `.env` `2026-10-12` → rebuild required |

**Explicit uncertainties**
- The production artifact could not be inspected; only the repository state was.
- Console-side settings (reCAPTCHA key, restrictions, Fraud Defense) were not accessible and are marked **NOT VERIFIED**.
- The observed `recaptchaConfig` values in the ticket may predate the current configuration; the probe results are timestamped at audit time.
