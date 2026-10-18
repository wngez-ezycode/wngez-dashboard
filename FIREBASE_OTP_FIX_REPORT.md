# Firebase OTP — Fix Implementation Report

**Project:** Wngez web (`website/`)
**Firebase project:** `wngez-cb47c` · **Production domain (asserted):** `wngez.com`
**Date:** 2026-10-18
**Scope:** safe code fixes for the confirmed defects listed in `FIREBASE_OTP_AUDIT_REPORT.md`.
**Not done here:** no deployment, no Firebase/Google Cloud setting change, no real SMS, no database change, no secret change.

> **Status:** the production `INVALID_APP_CREDENTIAL` issue is **not** claimed as fixed. The confirmed *code* defects are fixed and verified by lint + unit tests + a successful production build. Whether the live OTP now succeeds still requires the production verification in section G, because the decisive evidence (runtime `recaptchaConfig` for the deployed key) is only obtainable in the live browser/console.

---

## A. What was implemented

| # | Priority | Fix | Status |
|---|---|---|---|
| 1 | Duplicate `recaptcha-container` ids | One unique, always-attached host per flow: `login-recaptcha-container`, `register-recaptcha-container`, `delete-account-recaptcha-container` | ✅ done |
| 2 | Global `window.recaptchaVerifier` | Replaced by a component-scoped manager + hook; the global is no longer referenced anywhere | ✅ done |
| 3 | Creation / rendering / cleanup / concurrency | Explicit `render()`, reuse-only-if-attached, destroy on unmount and on dialog close, typed errors, single-flight creation and single-flight OTP sends | ✅ done |
| 4 | `display:none` host | Removed; hosts are empty, attached elements (invisible widget needs no hiding) | ✅ done |
| 5 | `lib/firebase.js` compat/modular | Compat initialisation removed; single modular init; FCM/Auth/service-worker behaviour preserved | ✅ done |
| 6 | Config path review | `projectId`, `authDomain`, `appId`, env handling re-verified without printing secrets | ✅ done |
| 7 | Dev-only diagnostics | New `lib/firebaseDiagnostics.js` (project id, SDK version, enforcement states, `recaptchaKey` presence) | ✅ done |
| 8 | `recaptchaConfig` may have changed | Re-checked read-only; current value is `AUDIT` + key (documented below) | ✅ done |
| 9 | Build/deployment inspection | Findings recorded in section F; no deployment performed | ✅ done |
| 10 | Preserve flows | Login, register, password recovery, delete-account, Laravel `user-signup`, test numbers untouched functionally | ✅ done |
| 11 | Error handling | `invalid-app-credential` now logs a safe, actionable hint; toast behaviour preserved | ✅ done |
| 12 | Checks | ESLint clean, 14 regression tests pass, `next build` succeeds | ✅ done |

---

## B. Modified / new files

### New files

| File | Purpose |
|---|---|
| `features/auth/lib/recaptchaVerifierManager.mjs` | Framework-agnostic verifier lifecycle: single verifier per manager, reuse only when not destroyed + rendered + attached to the **same** container, single-flight creation, typed `RecaptchaVerifierUnavailableError`, always clears on destroy. |
| `features/auth/hooks/useRecaptchaVerifier.js` | React wrapper: waits for the modal's container (portal/mount race), creates `RecaptchaVerifier(auth, container, { size: "invisible" })`, renders it eagerly, destroys on unmount. |
| `lib/firebaseDiagnostics.js` | Development-only diagnostics. Prints projectId/authDomain/appId, `SDK_VERSION`, a **SHA-256 fingerprint prefix** of the API key (never the key), per-provider enforcement state and `hasRecaptchaKey`. |
| `tests/recaptchaVerifierManager.test.mjs` | 10 lifecycle/concurrency regression tests (Node built-in test runner, no new dependencies). |
| `tests/recaptchaContainers.test.mjs` | 4 static regression tests: unique container ids, no `display:none`, no `window.recaptchaVerifier`, hook used by every flow. |

### Modified files

| File | Change |
|---|---|
| `lib/firebase.js` | Removed `import firebase from "firebase/compat/app"`, the compat `initializeApp()` call and the `firebase` field of the returned object. Single modular init: `export const app = getApps().length ? getApp() : initializeApp(firebaseConfig);`. `authentication`, FCM helpers, `signOut`, `revokeToken`, `onMessageListener` and the service-worker registration are unchanged. |
| `lib/form.js` | Added `logFirebaseAuthError(error, context)` with non-sensitive, actionable hints (`invalid-app-credential`, `missing-recaptcha-token`, `argument-error`, `too-many-requests`, `quota-exceeded`). `handleFirebaseAuthError` now accepts an optional third `error` argument and logs the hint before showing the translated toast. |
| `store/providers.jsx` | Added a dev-only `useEffect` that dynamically imports `lib/firebaseDiagnostics` (`NODE_ENV !== "production"`), so the diagnostics module is dead-code-eliminated from production. |
| `features/auth/login/LoginModal.jsx` | Hook (`login-recaptcha-container`), removed `generateRecaptcha`/`recaptchaClear`/unmount cleanup, verifier destroyed when the dialog closes, single-flight guard on `handleForgotPassword`, safe error logging, container id changed, no `display:none`. |
| `features/auth/register/RegisterWithMobileForm.jsx` | Hook (`register-recaptcha-container`), removed the global verifier code, `getVerifier()` used for the send + resend path, single-flight submit guard (`otpRequestInFlight`), safe error logging, `generateRecaptcha={getVerifier}` passed to `OtpScreen`. |
| `features/auth/register/RegisterModal.jsx` | Container renamed to `register-recaptcha-container`, `display:none` removed. |
| `features/auth/DeleteAccountVerifyOtpModal.jsx` | Hook (`delete-account-recaptcha-container`), removed global verifier code, verifier cleared on close, single-flight guards for send/resend and verify, `confirmationResult` null guard, safe error logging, container renamed, no `display:none`. |
| `features/auth/OtpScreen.jsx` | Single-flight verify and resend guards, `confirmationResult` null guard, safe error logging, no more `console.log(error)`. |
| `package.json` | Added `"test:auth": "node --test tests/*.test.mjs"` (no dependency installed). |

### Behaviour that intentionally did **not** change

- reCAPTCHA stays enabled; nothing bypasses Firebase verification.
- `signInWithPhoneNumber` / `ConfirmationResult.confirm` / `user-signup` payloads unchanged.
- Login (email/password + Google), registration (email + mobile), password recovery, delete-account, test numbers: same flows.
- FCM/service worker: untouched (`public/firebase-messaging-sw.js` not modified).
- No global CSS or layout change.

---

## C. Detailed fix notes

### C.1 Why the lifecycle matters

The old code stored one verifier on `window`:

```js
if (window.recaptchaVerifier && !window.recaptchaVerifier.destroyed) return window.recaptchaVerifier;
```

Three modals called it. Because Radix unmounts a closed dialog's content, the container that a cached verifier was rendered into could be removed from the DOM while the verifier was still “not destroyed”. The verifier was then reused against a detached node.

New rule (enforced by `recaptchaVerifierManager.mjs` and covered by tests):

```
reuse  ⇔  verifier exists
       ∧  !verifier.destroyed
       ∧  verifier.widgetId !== undefined      (render() completed)
       ∧  container === the same element
       ∧  container.isConnected
```

Otherwise: `clear()` the previous widget, empty the container, create + `render()` a new verifier.

### C.2 Container strategy

Each flow now owns exactly one empty host, rendered inside its own dialog content:

```jsx
<div id="login-recaptcha-container" />
<div id="register-recaptcha-container" />
<div id="delete-account-recaptcha-container" />
```

`display:none` was removed. The widget itself is invisible (`size: "invisible"`), so the host needs neither size nor hiding; `display:none` can prevent `grecaptcha` from rendering in some browsers.

The host is deliberately placed in the **modal shell**, not inside the form, because the register form is replaced by `OtpScreen` after the OTP is sent — a host inside the form would disappear before “resend”.

### C.3 Concurrency and null safety

- `getVerifier()` never returns `null`; it throws `RecaptchaVerifierUnavailableError` (`container-missing`, `container-detached`, `render-failed`, …). Callers catch it through the normal error path.
- Each flow has a `useRef` single-flight guard so a double click cannot start two `sendVerificationCode` calls (which would create two `ConfirmationResult`s and two SMS).
- `OtpScreen` verifies that `confirmationResult` exists before calling `.confirm()` and guards double submits.

### C.4 Diagnostics output (development only)

On `localhost`, after opening any page:

```
[firebase:diagnostics] runtime config { projectId: "wngez-cb47c", authDomain: "…", appId: "…", sdkVersion: "11.9.1", apiKeyFingerprint: "…" }
[firebase:diagnostics] reCAPTCHA Enterprise { hasRecaptchaKey: true, enforcement: { PHONE_PROVIDER: "AUDIT", … }, willFallbackToV2: false }
```

Reading it:

| Output | Meaning |
|---|---|
| `hasRecaptchaKey: true` + `PHONE_PROVIDER: AUDIT/ENFORCE` | SDK will use Enterprise; the request must **not** contain `captchaResponse: "NO_RECAPTCHA"`. |
| `hasRecaptchaKey: false` | SDK silently falls back to reCAPTCHA v2 — exactly the request shape seen in the incident. Fix the config, not the code. |
| `projectId` ≠ `wngez-cb47c` | The running bundle carries a stale/foreign env — rebuild with the verified `.env`. |

No key, token, phone number or ID token is ever printed.

---

## D. Checks and results

| Check | Command | Result |
|---|---|---|
| ESLint (all touched files) | `npx eslint lib/firebase.js lib/form.js lib/firebaseDiagnostics.js store/providers.jsx features/auth/hooks/useRecaptchaVerifier.js features/auth/lib/recaptchaVerifierManager.mjs features/auth/login/LoginModal.jsx features/auth/register/RegisterWithMobileForm.jsx features/auth/register/RegisterModal.jsx features/auth/DeleteAccountVerifyOtpModal.jsx features/auth/OtpScreen.jsx` | **0 errors / 0 warnings** |
| Regression tests | `npm run test:auth` | **14 passed, 0 failed** (`node:test`, no new packages) |
| Production build | `NEXT_TELEMETRY_DISABLED=1 npx next build` | **Success** — all routes compiled, `BUILD_ID` regenerated (`2026-10-18T23:33`) |
| Static leftovers | `grep -rn "window.recaptchaVerifier\|generateRecaptcha =\|recaptchaClear" features lib` | **none** |
| Dev server render | `GET http://127.0.0.1:3000/` | **HTTP 200** |

Build warning (pre-existing, unrelated): Turbopack reports `package-lock.json` outside the git repo root; it suggests setting `turbopack.root`. No action taken.

Tests cover: create-once, reuse, single-flight creation, container replacement (modal switching), destroyed-verifier recreation, destroy semantics, container missing/detached, render failure recovery, unique container ids, no `display:none`, no `window.recaptchaVerifier`, hook usage in every flow.

---

## E. Current Firebase configuration evidence (read-only, re-checked)

Using the repository's `NEXT_PUBLIC_API_KEY` (never printed):

| Endpoint | Result |
|---|---|
| `GET https://identitytoolkit.googleapis.com/v1/projects` | `200`; authorized domains `localhost`, `wngez-cb47c.firebaseapp.com`, `wngez-cb47c.web.app`, `wngez.com` |
| `GET https://identitytoolkit.googleapis.com/v2/recaptchaConfig` | `200`; `PHONE_PROVIDER: AUDIT`; **`recaptchaKey` present**; `useSmsTollFraudProtection: true` |
| `GET https://identitytoolkit.googleapis.com/v1/recaptchaParams` | `200`; v2 site key present |

**Interpretation:** the configuration attached to *this* key currently exposes an Enterprise key. The incident capture showed `ENFORCEMENT_STATE_UNSPECIFIED` **without** a key, which cannot produce the same client behaviour. Either the configuration changed after the capture, or the failing client used a different API key/bundle. Both possibilities remain open until the **live** runtime key is fingerprinted (section G).

---

## F. Deployment / build inspection (no changes made)

| Observation | Evidence | Impact |
|---|---|---|
| `https://wngez.com/` currently serves a **WordPress/MyListing** site (WooCommerce + Elementor), not the Next.js marketplace | live fetch; only `AIza…` string is a Google-Maps token inside `MyListing.MapConfig` | **The audited Next.js build may not be the artifact users hit.** Confirm the real host before deploying. |
| Local `.next` before this task was built on **2026-09-29** while `.env` was modified **2026-10-12** | file mtimes | Any artifact older than the last `.env` change carries stale `NEXT_PUBLIC_*` values. |
| `NEXT_PUBLIC_*` are inlined at build time | `lib/firebase.js` | A rebuild is mandatory after any env change; restarting the server is not enough. |
| Second hard-coded Firebase config in `public/firebase-messaging-sw.js` | lines 5–12 | FCM-only; can drift from `.env`; a cached service worker can survive a key rotation. Not changed (out of scope, preserved intentionally). |
| No CSP/`headers()` configured | `next.config.mjs` | Nothing blocks reCAPTCHA today; if a CSP is added later it must allow `google.com/recaptcha`, `gstatic.com` and `identitytoolkit.googleapis.com`. |

A fresh production build was produced **locally** for verification; it was **not** deployed.

---

## G. Exact production deployment and verification steps (to be executed separately, with approval)

### G.0 Pre-flight (no deploy)

1. Identify the host actually serving the Next.js frontend (the apex domain currently returns WordPress):
   ```bash
   curl -sI https://<candidate-host>/ | head -20
   curl -s https://<candidate-host>/ | grep -o '/_next/static[^"]*' | head
   ```
2. Confirm the source of production env values (hosting panel / `.env.production` / CI secrets). Do **not** paste them into tickets.
3. Confirm the build pipeline runs `npm run build` **after** the env values are set.

### G.1 Deploy

4. Build the artifact from the verified environment (`npm run build`).
5. Deploy the exact artifact. Do not serve a cached bundle; purge CDN/SW caches if the host uses them.

### G.2 Verify the runtime configuration (no SMS)

6. Open the production site with DevTools → **Network**, filter `recaptchaConfig`.
7. Trigger the phone step (the request fires when the verifier is initialised / the OTP is sent).
8. Expected: `200` with `recaptchaKey` present and `PHONE_PROVIDER` `AUDIT` or `ENFORCE`.
   - If `recaptchaKey` is missing → the deployed key/environment is wrong; **stop**, fix the build/env (H-1), do not chase code.
9. In the console, read the runtime project:
   ```js
   firebase.app().options.projectId        // must be wngez-cb47c
   ```
   and compare a **hashed** fingerprint of `firebase.app().options.apiKey` with the intended key out-of-band.
10. Inspect the DOM: exactly one `[id$="-recaptcha-container"]` element exists, it is attached, and it is not `display:none`.

### G.3 Functional verification (one real OTP)

11. Send a real OTP **once** from production; expect `200` on `accounts:sendVerificationCode`.
12. Confirm the code; expect a Firebase user and a successful Laravel `user-signup`.
13. Test resend once after 60 s; expect one new `ConfirmationResult`, one widget.
14. Test modal switching (login → register) without sending extra SMS: the verifier must be recreated, one host only.

### G.4 Console-side checks still required (flagged for review, not changed by this task)

15. Identity Platform → Fraud Defense → `PHONE_PROVIDER` mode and web key **for project `wngez-cb47c`**.
16. reCAPTCHA Enterprise key: platform **Web**, allowed domains include every serving origin (`wngez.com`, `www.wngez.com`, staging, preview).
17. API key: application restrictions include the exact origins; API restrictions allow **Identity Toolkit API**.
18. Firebase → Authorized domains include the exact serving host.

### G.5 Rollback

19. Re-deploy the previous artifact (the code changes are additive; no data/settings migration is involved).
20. No rollback is needed for Firebase settings because none were changed.

---

## H. Remaining unverified root-cause hypotheses

| Hypothesis | Status after this task | What would settle it |
|---|---|---|
| **H-1** Runtime client used a different/stale Firebase config (no `recaptchaKey` → v2 fallback → `INVALID_APP_CREDENTIAL`) | **Still unverified in production.** The code now makes this visible in dev and impossible to hide in the request shape (the SDK will use Enterprise when a key exists). | G.2 steps 6–9 on the live host. |
| **H-2** reCAPTCHA Enterprise key/domain binding rejects the assessment | **Unverified** (console-side). Current key exists; domains unknown. | G.4 step 16 + a single Enterprise token assessment (no SMS). |
| **H-3** Verifier lifecycle produced an unusable v2 token | **Code defects fixed** (E-1…E-5). Whether it was the production trigger is **unverified**, because it cannot be reproduced without the live failure. | G.3 steps 11–14. |
| **H-4** API key restrictions / referrers | **Unverified** (console-side). | G.4 step 17. |
| **H-5** Wrong project / multi-app / tenant | **Not supported by the repository key** (it resolves to the intended project). Only a live runtime key from another project would reproduce it. | G.2 step 9. |

**Explicit uncertainty:** the original `INVALID_APP_CREDENTIAL` was not reproduced (no SMS sent, no production credentials, no console access). This task removed the confirmed code-level causes of invalid/expired verifier reuse and made configuration mismatches observable, but it cannot certify the live OTP flow.

---

## I. Regression test inventory

```
tests/recaptchaVerifierManager.test.mjs    10 tests
  ✓ create + render once
  ✓ reuse while attached
  ✓ single-flight creation
  ✓ recreate on container replacement (modal switch)
  ✓ recreate after destroy
  ✓ destroy clears widget/container
  ✓ fresh verifier after manager destroy
  ✓ typed container-missing error
  ✓ typed container-detached error
  ✓ failed render leaves no stale verifier

tests/recaptchaContainers.test.mjs          4 tests
  ✓ one unique host id per modal
  ✓ no display:none on hosts
  ✓ no window.recaptchaVerifier anywhere in features/auth
  ✓ every phone flow uses useRecaptchaVerifier
```

Run with `npm run test:auth`.

---

## J. Files intentionally not touched

- `public/firebase-messaging-sw.js` (FCM config — preserved as required).
- Google Cloud / Firebase console settings, billing, quotas.
- Deployment configuration, `.htaccess`, `server.js`, CI.
- `.env` values (no secret was read, printed or modified).
- Any database or Laravel backend code.
