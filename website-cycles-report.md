# تقرير دورات العمل (Cycles) في موقع الويب — eClassify / WngeZ Web

**المسار:** `website/`
**التقنيات:** Next.js 16 (App Router) + React 19 + Redux Toolkit & redux-persist + Tailwind 4 + Firebase (Auth/FCM) + Stripe / Razorpay + Leaflet & Google Maps
**تاريخ التقرير:** 2026-10-12 — جرد كامل للمستودع (قراءة فقط، بدون أي تعديل على ملفات الموقع)
**حالة التحقق:** تمت إعادة التحقق من كل الأرقام أدناه مباشرة من شجرة الملفات و `git status` في نفس تاريخ التقرير.

---

## 1) ملخص تنفيذي

الموقع هو واجهة **سوق مبوّبات (Classified Marketplace)** متعدّد اللغات، يعمل كطبقة عرض كاملة فوق API خارجي (Laravel).

| المؤشر | القيمة |
|---|---|
| صفحات (App Router `page.jsx`) | **34** |
| مجالات الميزات (`features/*/`) | **25** |
| عدد نقاط الـ API المعلنة | **94** في `lib/api/index.js` (1545 سطر) |
| ملفات JS/JSX (بدون node_modules/.next) | **411** |
| صفحات Sitemap | 6 (main / ads / featured / blogs / categories / seller) |
| عدد الـ Commits | 1 (`fafb309 Initial commit - wngez-website`) + **37 معدّل** + **51 غير متتبَّع** = 88 تغييرًا في شجرة العمل |
| ملفات ترجمة محلية | `lang/locale/ar.json` (808 سطر) + `lang/locale/en.json` (809 سطر) — كلاهما محلي الآن |
| مسارات API داخل الموقع (Route Handlers) | 2 (`api/lang-codes`, `api/revalidate-lang-codes`) |

**الحالة المهمة:** الموقع في منتصف **إعادة تسمية (Rebrand) من eClassify إلى WngeZ** — تظهر في `app/[lang]/layout.jsx`, `components/layout/Footer.jsx`, `components/common/PageLoader.jsx`, `features/navigation/home/HomeHeader.jsx`, `public/firebase-messaging-sw.js`، مع **صفحة رئيسية جديدة** (`features/discovery/hero/WngezHero.jsx`, `features/discovery/featured-ads/WngezFeaturedAds.jsx`) وصور إعلانات تجريبية جديدة في `public/assets/`.

---

## 2) المعمارية: كيف تعمل أي "دورة" في الموقع

```
طلب المتصفح
   ↓
proxy.js  (وسيط Next 16)  → يتحقق من كود اللغة + يزرع lang cookie و SEED_COOKIE
   ↓
app/[lang]/layout.jsx → AppBootstrap (get-system-settings) → Providers (Redux persisted)
   ↓
app/[lang]/<route>/page.jsx (Server Component: SEO + جلب أولي عبر lib/server/*)
   ↓
features/<domain>/*.jsx  (Client Component: التفاعل الكامل)
   ↓
lib/api/index.js  (94 endpoint)
   ↓
lib/api/AxiosInterceptors.jsx → Authorization: Bearer <token> + Content-Language + seed header
   ↓
[ 401 → userLogout + UnauthorizedModal ]   [ 200 → Redux store update / Toast ]
```

- **جلب البيانات على السيرفر:** `lib/server/bootstrap.js`, `adDetail.js`, `seo.js`, `etagFetch.js`, `cacheTags.js`, `locationCookie.js`.
- **الحالة العامة (Redux):** `authSlice` (بيانات المستخدم + عدّادات الشات غير المقروء + المتابعة), `settingSlice`, `categorySlice`, `chatSlice`, `languageSlice`, `globalStateSlice`.
- **حماية المسارات:** HOC `features/auth/Checkauth.jsx` بقائمة مسارات خاصة ثابتة.

---

## 3) جرد الدورات — 50 دورة عمل

### أ) دورات الهوية والحساب (8 دورات)

| # | الدورة | نقطة الدخول | الملفات الرئيسية | الـ API |
|---|---|---|---|---|
| A-01 | التسجيل والدخول (بريد / موبايل) | `LoginModal` | `features/auth/login/LoginWithEmailForm.jsx`, `LoginWithMobileForm.jsx`, `features/auth/register/RegisterWithEmailForm.jsx`, `RegisterWithMobileForm.jsx` | `user-signup`, `user-exists` |
| A-02 | التحقق بـ OTP | `OtpScreen` | `features/auth/OtpScreen.jsx`, `MailSentSuccessModal.jsx`, `hooks/useAutoFocus.jsx` | `get-otp`, `verify-otp` |
| A-03 | الدخول بجوجل | `GoogleConsentModal` | `features/auth/GoogleConsentModal.jsx`, `lib/firebase.js`, `google_client_secret.json` | `user-signup` (firebase_id) |
| A-04 | نسيت كلمة المرور | `ResetPasswordScreen` | `features/auth/ResetPasswordScreen.jsx`, `MailSentSuccessModal.jsx` | `reset-password` |
| A-05 | حذف الحساب بتأكيد OTP | `DeleteAccountVerifyOtpModal` | `features/auth/DeleteAccountVerifyOtpModal.jsx` | `delete-user`, `verify-otp` |
| A-06 | تسجيل الخروج + إلغاء FCM | Header / Sidebar | `store/slices/authSlice.js` (`userLogout`) | `logout` |
| A-07 | حماية المسارات + 401 | HOC حول الصفحات | `features/auth/Checkauth.jsx`, `UnauthorizedModal.jsx`, `globalStateSlice.js`, `AxiosInterceptors.jsx` | — (اعتراض 401) |
| A-08 | توثيق الحساب (KYC) | `/user-verification` | `features/user-verification/UserVerification.jsx`, `lib/validation.js`, `lib/prefill.js` | `verification-fields`, `send-verification-request`, `verification-request` |

**المسارات الخاصة المفروضة في `Checkauth.jsx`:** `/profile`, `/ad-listing`, `/notifications`, `/chat`, `/user-subscription`, `/my-ads`, `/favorites`, `/transactions`, `/reviews`, `/edit-listing`, `/user-verification`, `/job-applications`.

---

### ب) دورات الإعلانات (12 دورة) — قلب الموقع

| # | الدورة | نقطة الدخول | الملفات الرئيسية | الـ API |
|---|---|---|---|---|
| B-01 | **نشر إعلان جديد (Wizard 6 خطوات)** | `/ad-listing` | `features/listing/create/AdsListing.jsx` (642 سطر), `CategorySelectToListAd`, `MainDetails`, `ExtraDetails`, `shared/MetaDetails`, `shared/ImageUpload`, `shared/ListingLocation`, `shared/VideoCard`, `hooks/useWizard.jsx`, `hooks/useFileDropzone.js`, `hooks/useFFmpeg.js`, `lib/{payload,formData,validation,slug,video}.js` | `add-item`, `get-customfields`, `upload-media`, `gemini/generate-meta`, `gemini/generate-description`, `get-limits` |
| B-02 | بوابة الحزمة (مدفوع/مجاني) | داخل الـ Wizard | `components/common/PackageRequiredModal.jsx`, `features/subscription/FreeAdListingPlaceholder.jsx` | `get-user-purchased-packages`, `assign-free-package` |
| B-03 | تعديل إعلان | `/edit-listing/[id]` | `features/listing/edit/EditListing.jsx`, `EditMainDetails`, `EditExtraDetails`, `EditImageUpload`, `shared/EditVideoModal`, `AdsEditSuccessModal` | `update-item` |
| B-04 | إعلاناتي (إدارة) | `/my-ads` | `features/listing/manage/MyAds.jsx`, `MyAdsCard.jsx`, `GetMyAdStatus.jsx` | `my-items` |
| B-05 | تغيير حالة الإعلان (بيعت/متاح) | تفاصيل الإعلان | `features/ad-details/owner/AdsStatusChangeCards.jsx`, `SoldOutModal.jsx` | `update-item-status` |
| B-06 | تجديد الإعلان | تفاصيل الإعلان | `features/ad-details/owner/RenewAd.jsx` | `renew-item` |
| B-07 | تمييز الإعلان (Featured) | تفاصيل الإعلان | `features/ad-details/owner/MakeFeaturedAd.jsx` | `make-item-featured` |
| B-08 | حذف الإعلان | إعلاناتي / التفاصيل | `components/common/DeleteConfirmDialog.jsx` | `delete-item` |
| B-09 | إعلان معدّل بواسطة الأدمن | تفاصيل الإعلان | `features/ad-details/owner/AdEditedByAdmin.jsx` | `update-item` (من لوحة الأدمن) |
| B-10 | تفاصيل إعلاني الخاص | `/my-listing/[slug]` | `features/ad-details/owner/MyAdsListingDetailCard.jsx` | `my-items` |
| B-11 | تتبّع النقرات/المشاهدات | صفحة التفاصيل | `features/ad-details/AdDetails.jsx` | `set-item-total-click` |
| B-12 | الإعلانات المميزة العامة | `/ads/featured/[slug]` | `features/discovery/featured-ads/WngezFeaturedAds.jsx` | `get-featured-section` |

**خطوات الـ Wizard:** `category` → `details` → `extra` (شرطية: تظهر فقط عند وجود Custom Fields) → `meta` → `media` → `location`.

---

### ج) دورات التصفح والاكتشاف (9 دورات)

| # | الدورة | نقطة الدخول | الملفات الرئيسية | الـ API |
|---|---|---|---|---|
| C-01 | الصفحة الرئيسية | `/` | `features/discovery/hero/WngezHero.jsx`, `discovery/featured-ads/`, `popular-categories/`, `offers/`, `all-items/`, `explore-videos/`, `features/marketing/*` | `get-slider`, `get-featured-section`, `get-popular-categories`, `get-item-list`, `get-banner-ads`, `get-popular-blogs` |
| C-02 | الأقسام والتصنيفات | `/ads/[...categorySlug]` | `features/ads/AdsShell.jsx`, `AdsGrid.jsx`, `AdsToolbar.jsx`, `AdsCategoryCarousel.jsx`, `lib/adsData.js` | `get-categories`, `get-parent-categories` |
| C-03 | البحث والفلترة | `/ads` | `features/filter/Filter.jsx`, `ActiveFilters`, `BudgetFilter`, `DatePostedFilter`, `ExtraDetailsFilter`, `CategoryNode`, `FilterTree`, `LocationTree`, `hooks/*` | `get-item-list` (بمعاملات الفلترة) |
| C-04 | تفاصيل الإعلان | `/ad-details/[slug]` | `features/ad-details/AdDetails.jsx`, `AdGallery`, `AdFeature`, `AdLocation`, `AdDescription`, `SimilarAds(Section)`, `AdDetailCard`, `SellerDetailCard`, `owner/*`, `jobs/*`, `report/*` | `get-item-list` (عنصر), `get-seller`, `get-report-reasons` |
| C-05 | صفحة البائع | `/seller/[id]` | `features/seller/Seller.jsx`, `SellerTabs`, `SellerDetailCard`, `SellerJsonLd`, `SellerSkeleton`, `SellerNotFound`, `listings/*`, `reviews/*` | `get-seller`, `followers`, `following`, `follow-user`, `unfollow-user` |
| C-06 | المفضلة | `/favorites` | `features/favorites/Favorites.jsx` | `manage-favourite`, `get-favourite-item` |
| C-07 | المدونة | `/blogs`, `/blogs/category/[slug]`, `/blogs/[slug]` | `features/blogs/Blogs.jsx`, `BlogDetailPage.jsx`, `detail/`, `list/`, `shared/` | `blogs`, `blog-categories`, `blog-tags`, `get-popular-blogs`, `set-blog-feedback` |
| C-08 | FAQ + الصفحات القانونية + تواصل | `/faqs`, `/about-us`, `/privacy-policy`, `/terms-and-condition`, `/refund-policy`, `/contact-us` | `features/faq/*`, `features/legal/*`, `features/contact/ContactUs.jsx` | `faq`, `contact-us` |
| C-09 | الريلز (Reels) | `/reel`, `/reel/[id]` | `features/reels/ReelPlayer.jsx` | `get-reels`, `get-my-reels`, `manage-reel-like`, `get-liked-reels`, `item-offer`, `follow-user` |

**ملاحظة تقنية:** الريلز للزوار تستخدم `SEED_COOKIE` يُزرع في `proxy.js` لضمان توزيع عشوائي ثابت (Shuffle) بين السيرفر والمتصفح.

---

### د) دورات التواصل (5 دورات)

| # | الدورة | نقطة الدخول | الملفات الرئيسية | الـ API |
|---|---|---|---|---|
| D-01 | الشات (بيع/شراء) | `/chat` | `features/chat/Chat.jsx`, `list/*` (ChatSidebar, ChatList, ChatTabs, BuyingChatList, BlockedUsersMenu, AdList, Toolbar), `conversation/*` (ChatMessages, ChatMessage, SendMessage, QuickReplies, SelectedChatHeader), `hooks/*`, `store/slices/chatSlice.js` | `chat-list`, `chat-messages`, `send-message`, `item-offer-list`, `delete-chat`, `delete-chat-messages`, `chat-template-questions` |
| D-02 | تقديم عرض سعر (Offer) | تفاصيل الإعلان / الشات | `features/ad-details/MakeOfferModal.jsx` (وضع إنشاء + تعديل) | `item-offer`, `tips`, `send-message` |
| D-03 | حظر / فك حظر مستخدم | الشات | `features/chat/list/BlockedUsersMenu.jsx` | `block-user`, `unblock-user`, `blocked-users` |
| D-04 | الإشعارات (داخلية + Push) | `/notifications` | `features/notifications/Notifications.jsx`, `NotificationSkeleton.jsx`, `components/layout/PushNotificationLayout.jsx`, `lib/firebase.js`, `public/firebase-messaging-sw.js` | `get-notification-list` + Firebase FCM |
| D-05 | الإبلاغ (إعلان / تقييم) | تفاصيل الإعلان | `features/ad-details/report/ReportModal.jsx`, `AdsReportCard.jsx`, `features/reviews/received/ReportReviewModal.jsx` | `get-report-reasons`, `add-reports`, `add-review-report` |

---

### هـ) دورات الدفع والاشتراكات (6 دورات)

| # | الدورة | نقطة الدخول | الملفات الرئيسية | الـ API |
|---|---|---|---|---|
| E-01 | الاشتراك واختيار الحزمة | `/subscription`, `/user-subscription` | `features/subscription/CategorySelectionSubscription.jsx`, `ProfileSubscription.jsx`, `PurchasedPlanCard.jsx`, `BuyPackageCard.jsx`, `AddListingPlanCardSkeleton.jsx` | `get-package`, `get-user-purchased-packages` |
| E-02 | شراء حزمة + تنفيذ الدفع | `/subscription` | `features/subscription/BuyPackage.jsx`, `payment-modal/PaymentModal.jsx`, `PaymentMethods.jsx`, `PaymentSummary.jsx`, `SelectedPlan.jsx`, `StripePayment.jsx`, `LoyaltyPoints.jsx`, `BankDetailsModal.jsx`, `lib/paymentConstants.js`, `lib/getPackageVars.js` | `get-payment-settings`, `payment-intent` |
| E-03 | المعاملات والفواتير | `/transactions` | `features/transactions/Transactions.jsx`, `TransactionSkeleton.jsx`, `DownloadPdf.jsx` (html2pdf), `UploadReceiptModal.jsx`, `ViewReceiptModal.jsx` | `payment-transactions`, `get-payment-receipt`, `bank-transfer-update`, `make-payment-transaction-fail` |
| E-04 | الإحالة واكسب | `/refer-and-earn` | `features/refer-and-earn/ReferAndEarn.jsx` | `referral-code`, `refer-points-balance` |
| E-05 | نقاط الولاء (Loyalty) | داخل نافذة الدفع | `features/subscription/payment-modal/LoyaltyPoints.jsx` | `payment-intent` |
| E-06 | مشترياتي | تقييمات/مشتريات | `features/reviews/given/PurchasedItemCard.jsx` | `my-purchased-items` |

**طرق الدفع المدعومة:** `stripe` · `razorpay` · `bank_transfer` (مع رفع إيصال) · `loyalty points` — وتُفعَّل/تُطفأ ديناميكيًا من `get-payment-settings`.

---

### و) دورات الوظائف والتقييمات (4 دورات)

| # | الدورة | نقطة الدخول | الملفات الرئيسية | الـ API |
|---|---|---|---|---|
| F-01 | التقديم على وظيفة | تفاصيل إعلان وظيفة | `features/ad-details/jobs/ApplyJobModal.jsx`, `JobApplicationModal.jsx` (رفع CV/Resume) | `job-apply` |
| F-02 | إدارة طلبات الوظائف | `/job-applications` | `features/job-applications/JobApplications.jsx`, `JobApplicationSkeleton.jsx`, `jobs/JobApplicationCard.jsx` | `get-job-applications`, `update-job-applications-status`, `my-job-applications` |
| F-03 | تقييم البائع/المشتري | `/reviews` | `features/reviews/Reviews.jsx`, `given/GiveReviewModal.jsx`, `given/GivenReviewsList.jsx`, `given/PurchasedItemCard.jsx` | `add-item-review`, `my-review` |
| F-04 | المراجعات المستلمة | `/reviews` | `features/reviews/received/ReceivedReviewsList.jsx`, `MyReviewsCard.jsx`, `RatingsSummarySkeleton.jsx`, `components/common/RatingsSummary.jsx`, `StarRating.jsx` | `my-review` |

---

### ز) دورات المنصة والتقنية (6 دورات)

| # | الدورة | الملفات / المسارات | التفاصيل |
|---|---|---|---|
| G-01 | **اللغة والتوجيه** | `proxy.js`, `app/api/lang-codes/route.js`, `app/api/revalidate-lang-codes/route.js`, `lang/index.js`, `lang/useTranslation.jsx`, `lang/locale/{ar,en}.json` | تحويل كل مسار إلى `/[lang]`، زرع `lang` cookie + `SEED_COOKIE`، جلب لغات النظام عبر `get-languages`. محليًا: **`ar.json` + `en.json`** فقط، وباقي اللغات من الـ API. |
| G-02 | **SEO والكاش** | `lib/server/seo.js`, `adDetail.js`, `etagFetch.js`, `bootstrap.js`, `cacheTags.js`, `app/sitemap.xml/route.js`, `app/(sitemap)/{main,ads,featured,blogs,categories,seller}`, `components/layout/StructuredData.jsx`, `features/seller/SellerJsonLd.jsx` | `seo-settings`، ETag + Cache Tags + Revalidate، 6 خرائط موقع، بيانات منظّمة (JSON-LD). |
| G-03 | **الإعدادات والتهيئة** | `components/layout/AppBootstrap.jsx`, `MaintenanceScreen.jsx`, `CookieBanner.jsx`, `useGetCategories.jsx`, `useGetLocation.jsx`, `store/slices/settingSlice.js` | `get-system-settings` → وضع الصيانة، الشعار، مفاتيح الميزات، الكوكيز. |
| G-04 | **الموقع والخرائط** | `features/location/*` (GetLocationWithMap, LocationModal, LocationSelector, Map, MapLocation, SearchAutocomplete), `components/common/MapComponent.jsx`, `ProviderMap.jsx`, `lib/location.js`, `lib/server/locationCookie.js` | `countries`, `states`, `cities`, `areas`, `get-location` — Leaflet + Google Maps. |
| G-05 | **التحليلات والإعلانات** | `lib/analytics.js`, `components/layout/AnalyticsLoader.jsx`, `ClarityAnalytics.jsx`, `components/adsense/*` (AdSlot, AdUnit, useAdsense, adConfig), `components/custom-banners/*` | GA + Microsoft Clarity + AdSense/Banner Ads. |
| G-06 | **فتح في التطبيق والمشاركة** | `components/common/OpenInApp.jsx`, `OpenInAppDrawer.jsx`, `ShareDropdown.jsx` | تحويل زوار المتصفح إلى تطبيق الموبايل + مشاركة الإعلانات. |

---

## 4) خريطة الصفحات ↔ الدورات (34 صفحة)

| المسار | الدورة |
|---|---|
| `/` , `/landing` | C-01 |
| `/ads` , `/ads/[...categorySlug]` , `/ads/featured/[slug]` | C-02, C-03, B-12 |
| `/ad-details/[slug]` | C-04 (+ B-05…B-11, D-02, D-05, F-01) |
| `/seller/[id]` | C-05 |
| `/blogs` , `/blogs/category/[slug]` , `/blogs/[slug]` | C-07 |
| `/reel` , `/reel/[id]` | C-09 |
| `/faqs` , `/about-us` , `/privacy-policy` , `/terms-and-condition` , `/refund-policy` , `/contact-us` | C-08 |
| `/ad-listing` , `/edit-listing/[id]` , `/my-listing/[slug]` | B-01, B-02, B-03, B-10 |
| `/(profile)/my-ads` , `/(profile)/favorites` , `/(profile)/chat` , `/(profile)/notifications` , `/(profile)/profile` | B-04, C-06, D-01, D-04, A-01…A-06 |
| `/(profile)/transactions` , `/(profile)/user-subscription` , `/subscription` | E-01…E-06 |
| `/(profile)/refer-and-earn` , `/(profile)/reviews` , `/(profile)/job-applications` | E-04, F-02…F-04 |
| `/user-verification` , `/cache-clear` , `/[...notFound]` | A-08, G-02 |
| `sitemap.xml` + 6 خرائط | G-02 |

---

## 5) الدورات المقترحة للعمل عليها (خطة مرحلية)

| المرحلة | الدورات | لماذا الآن |
|---|---|---|
| **1 — الأساس** | G-01 (اللغة)، A-07 (حماية المسارات)، G-02 (SEO/كاش) | أي تغيير في التوجيه أو الحماية يؤثر على كل الصفحات، لذا يُثبَّت أولًا. |
| **2 — الهوية** | A-01 … A-08 | المدخل الأساسي للمستخدمين، ويشمل إعادة التسمية إلى WngeZ ونصوص التسجيل. |
| **3 — الإعلانات** | B-01 … B-12 | أثقل وأهم دورة (3,537 سطر في `features/listing` + `ad-details/owner`). |
| **4 — الدفع** | E-01 … E-06 | حساس ماليًا: Stripe / Razorpay / تحويل بنكي / نقاط ولاء. |
| **5 — التواصل** | D-01 … D-05 | الشات + العروض + الإشعارات الفورية (FCM). |
| **6 — الاكتشاف** | C-01 … C-09 | الصفحة الرئيسية الجديدة (WngezHero/WngezFeaturedAds) والريلز والفلترة. |
| **7 — المكمّلات** | F-01 … F-04، G-03 … G-06 | وظائف، تقييمات، خرائط، تحليلات، Deep Links. |

### 5.1) توزيع حجم العمل حسب مجلد الميزة (لترتيب الأولوية)

| المجلد | عدد ملفات JS/JSX | الدورات المرتبطة |
|---|---|---|
| `features/listing` | 28 | B-01 … B-04 |
| `features/chat` | 26 | D-01 … D-03 |
| `features/ad-details` | 23 | C-04، B-05 … B-09، D-02، D-05، F-01 |
| `features/subscription` | 17 | E-01، E-02، E-05، B-02 |
| `features/discovery` | 16 | C-01، B-12 |
| `features/blogs` | 16 | C-07 |
| `features/auth` | 15 | A-01 … A-07 |
| `features/seller` | 13 | C-05 |
| `features/navigation` | 10 | الهيدر/الفوتر/البحث — G-01، G-06 |
| `features/reviews` | 9 | F-03، F-04 |
| `features/filter` | 9 | C-03 |
| `features/ads` | 8 | C-02، C-03 |
| `features/location` | 8 | G-04 |
| `features/marketing` | 6 | C-01 (بانرات/إعلانات) |
| `features/transactions` | 5 | E-03 |
| الباقي (legal, faq, user-verification, profile, notifications, job-applications, refer-and-earn, reels, favorites, contact) | 2 أو 1 لكل واحد | A-08، C-06، C-08، C-09، D-04، E-04، F-02 |

---

## 6) ملاحظات ومخاطر يجب الانتباه لها قبل العمل

1. **ملف سرّي خارج التتبّع:** `google_client_secret.json` موجود في جذر الموقع وغير متتبَّع في Git — يجب عدم إضافته أبدًا للمستودع، ويُفضَّل تدويره ونقله لخارج مجلد المشروع.
2. **إعادة التسمية غير مكتملة:** **37 ملفًا معدّلًا + 51 ملفًا غير متتبَّع** (منها `features/discovery/hero/`، `features/discovery/featured-ads/`، `lang/locale/ar.json`، مجموعة صور `public/assets/*`، وملف Postman جديد) بلا أي Commit بعد الـ Commit الأول — أي عمل جديد يجب أن يبدأ من حالة `git status` الحالية، لا من آخر Commit.
3. **قائمة المسارات الخاصة ثابتة (Hardcoded)** في `Checkauth.jsx` — أي صفحة محمية جديدة تُنسى بسهولة. يُفضَّل تحويلها إلى مصدر واحد (مثل `lib/constants.js`).
4. **94 نقطة API في ملف واحد (1545 سطر)** — فصلها لكل `features/<domain>/api.js` سيقلّل تضارب التعديلات.
5. **التوكن محفوظ في `localStorage`** عبر redux-persist + `Authorization: Bearer` — سطح هجوم XSS؛ يجب مراجعة سياسة الـ CSP.
6. **الترجمة:** الملفات المحلية الآن `lang/locale/ar.json` (جديد غير متتبَّع) + `lang/locale/en.json` (معدَّل)؛ باقي اللغات تأتي من الـ API — أي مفتاح ترجمة جديد يجب إضافته في الملفين المحليين وفي لوحة الأدمن معًا، وإلا ظهر المفتاح الخام للمستخدم.
7. **ملفات نظام في المستودع:** `.DS_Store` متعدّدة + `.eslintrc.json` بحجم 39KB (مولّد آليًا).
8. **الجلسة تُزرع من `proxy.js`** بكوكي `SEED_COOKIE` غير `httpOnly` عن قصد (لعشوائية الريلز) — تأكد من عدم استخدامه لأي غرض أمني.
9. **التحقق:** أي تعديل يحتاج `npm run build` (Next 16) وليس فقط `npm run dev`، لأن `proxy.js` وServer Components لا تُختبر كاملًا في وضع التطوير.

---

## 7) الخلاصة

الموقع يحتوي **50 دورة عمل** موزّعة على 7 مجموعات: الهوية (8)، الإعلانات (12)، الاكتشاف (9)، التواصل (5)، الدفع (6)، الوظائف والتقييمات (4)، والمنصة (6) — تنطلق كلها من **34 صفحة** فوق **94 نقطة API**، مع دعم لغات متعدّد عبر `/[lang]`، ودفع متعدّد المزوّدين، وإشعارات فورية، وSEO مُخزَّن بكاش وسوم.

الحالة الراهنة **عمل جارٍ على إعادة التسمية إلى WngeZ + صفحة رئيسية جديدة**، وهي النقطة التي يجب تثبيتها قبل البدء بأي دورة جديدة.
