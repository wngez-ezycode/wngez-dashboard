@php
    $currentLocale = app()->getLocale();
    $currentLang = Session::get('language') ?? \App\Models\Language::where('code', $currentLocale)->first();
    $isRtl = ($currentLang && $currentLang->rtl) || $currentLocale === 'ar' || Session::get('is_rtl', false);
@endphp
<!DOCTYPE html>
<html lang="{{ $currentLocale }}" @if ($isRtl) dir="rtl" class="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ $favicon ?? url('assets/images/logo/wngez-icon.png') }}" type="image/png">
    <title>@yield('title') || {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('layouts.include')
    @yield('css')
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main" class='layout-navbar'>
            @include('layouts.topbar')
            <div id="main-content">
                @if (!request()->is('home'))
                    <section class="wngez-page-hero" aria-label="{{ __('Page header') }}">
                        <div class="wngez-breadcrumb">
                            <a href="{{ url('home') }}"><i class="ph ph-house"></i> {{ __('Dashboard') }}</a>
                            <i class="ph ph-caret-right"></i>
                            <span>@yield('title')</span>
                        </div>
                        <h1>@yield('title')</h1>
                        <p>{{ __('Manage and organize your marketplace data with ease.') }}</p>
                    </section>
                @endif
                <div class="page-heading">
                    @yield('page-title')
                </div>
                @yield('content')
            </div>
            <div class="dashboard-footer-wrap">
                <div class="content">
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer_script')
    @include('layouts.web-setup-popup')
    @yield('js')
    @yield('script')

    @if (config('app.demo_mode'))
        <!-- Floating Buy Now Button -->
        <div id="buyNowFloatBtn" class="buy-now-float-btn">
            <a href="https://wngez.com"
                target="_blank" class="buy-now-btn-content" rel="noopener noreferrer">
                <div class="buy-now-icon-wrapper">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="buy-now-text-wrapper">
                    <span class="buy-now-btn-title">{{ __('Buy Now') }}</span>
                    <span class="buy-now-btn-desc">{{ __('Like what you see? Get the full version') }}</span>
                </div>
            </a>
            <div id="buyNowToggle" class="buy-now-btn-action">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const btn = document.getElementById('buyNowFloatBtn');
                const toggle = document.getElementById('buyNowToggle');
                if (btn && toggle) {
                    // Read stored state
                    const isCollapsed = localStorage.getItem('buy_now_collapsed') === 'true';
                    if (isCollapsed) {
                        btn.classList.add('buy-now-collapsed');
                    }

                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const collapsed = btn.classList.toggle('buy-now-collapsed');
                        localStorage.setItem('buy_now_collapsed', collapsed ? 'true' : 'false');
                    });
                }
            });
        </script>
    @endif
</body>

</html>
