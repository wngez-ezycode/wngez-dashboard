<header>
    <nav class="navbar navbar-expand navbar-light dashboard-topbar">
        <div class="container-fluid">
            <div class="dashboard-topbar-start d-flex align-items-center">
                <a href="{{ url('home') }}" class="dashboard-brand">
                    <img src="{{ $settings['company_logo'] ?? asset('assets/images/logo/wngez-logo.png') }}"
                        data-custom-image="{{ asset('assets/images/logo/wngez-logo.png') }}" alt="WngeZ.com">
                </a>
                <div class="dashboard-topbar-toggle">
                    <a href="#" class="burger-btn burger-toggle topbar-burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </div>

                @if (config('app.demo_mode'))
                    <div class="col-2">
                        <span class="badge alert-info primary-background-color">{{ __('Demo Mode') }}</span>
                    </div>
                @endif
            </div>
            <div class="wngez-global-search d-none d-xl-flex">
                <i class="ph ph-magnifying-glass"></i>
                <input type="search" placeholder="{{ __('Search here...') }}" aria-label="{{ __('Search') }}">
            </div>


            <div class="dashboard-topbar-end justify-content-end d-flex">
                <div class="collapse navbar-collapse">

                    <div class="dropdown me-3">
                        <a href="#" class="user-dropdown d-flex align-items-center dropdown-toggle"
                            data-bs-toggle="dropdown">

                            <button class="dropdown-btn">


                                <img src="{{ $currentLanguage?->image }}" class="flag">
                                <span>{{ strtoupper($currentLanguage?->code) }}</span>
                                <span class="arrow">&#9662;</span>
                            </button>
                        </a>
                        {{-- {{ print_r($currentLanguage) }} --}}

                        <ul class="dropdown-menu dropdown-menu-end">

                            @foreach ($languages as $language)
                                <li class="d-flex justify-content-between align-items-center px-2 py-1"
                                    data-language-code="{{ $language->code }}">

                                    <a class="dropdown-item d-flex align-items-center flex-grow-1"
                                        href="{{ route('language.set-current', $language->code) }}">
                                        <img src="{{ $language->image }}" class="flag me-2">
                                        {{ $language->name }}
                                    </a>
                                    <form action="{{ route('settings.set-default-language') }}" method="POST"
                                        class="ms-2">
                                        @csrf
                                        <input type="hidden" name="default_language" value="{{ $language->code }}">

                                        @can('settings-update')
                                            <button type="submit" class="btn btn-sm btn-primary py-0 px-2"
                                                @if ($defaultLanguage && $defaultLanguage->code == $language->code) disabled @endif>
                                                {{ $defaultLanguage && $defaultLanguage->code == $language->code ? __('Default') : __('Set Default') }}
                                            </button>
                                        @endcan

                                    </form>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    @php
                        $recentNotifications = \App\Models\Notifications::latest()->take(5)->get();
                        $notificationsCount = \App\Models\Notifications::count();
                    @endphp

                    <div class="dropdown notification-dropdown-wrapper">
                        <a href="#" class="topbar-notification" id="notificationDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="{{ __('Notification') }}">
                            <i class="ph ph-bell"></i>
                            @if ($notificationsCount > 0)
                                <span class="notification-indicator"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu shadow-lg p-0"
                            aria-labelledby="notificationDropdown">
                            <div
                                class="notification-dropdown-header d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ph ph-bell text-primary fs-5"></i>
                                    <h6 class="mb-0 fw-bold fs-6">{{ __('Notifications') }}</h6>
                                </div>
                                @if ($notificationsCount > 0)
                                    <span class="badge bg-primary rounded-pill px-2 py-1"
                                        style="font-size: 11px;">{{ $notificationsCount }}</span>
                                @endif
                            </div>

                            <div class="notification-dropdown-body">
                                @forelse($recentNotifications as $notification)
                                    <a href="{{ url('notification') }}"
                                        class="notification-dropdown-item d-flex align-items-start px-3 py-2 text-decoration-none border-bottom">
                                        <div class="notification-item-icon me-3 flex-shrink-0">
                                            @if (!empty($notification->getRawOriginal('image')))
                                                <img src="{{ $notification->image }}" alt=""
                                                    class="rounded-circle"
                                                    style="width: 36px; height: 36px; object-fit: cover;">
                                            @else
                                                <div
                                                    class="notification-icon-placeholder rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="ph ph-bell-simple"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="notification-item-content flex-grow-1 min-w-0">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <h6 class="notification-item-title mb-0 text-truncate fw-semibold">
                                                    {{ $notification->title }}</h6>
                                                <span class="notification-item-time text-muted flex-shrink-0 ms-2">
                                                    {{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}
                                                </span>
                                            </div>
                                            <p class="notification-item-desc mb-0 text-muted">
                                                {{ $notification->message }}
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="notification-empty-state text-center py-4 px-3">
                                        <div class="notification-empty-icon mb-2">
                                            <i class="ph ph-bell-slash"></i>
                                        </div>
                                        <p class="mb-1 fw-semibold text-secondary" style="font-size: 13.5px;">
                                            {{ __('No notifications found') }}</p>
                                        <small class="text-muted"
                                            style="font-size: 11.5px;">{{ __('You are all caught up!') }}</small>
                                    </div>
                                @endforelse
                            </div>

                            <div class="notification-dropdown-footer p-2 text-center border-top">
                                <a href="{{ url('notification') }}"
                                    class="notification-more-btn btn btn-sm w-100 fw-bold">
                                    {{ __('More') }}
                                    <i
                                        class="ph {{ Session::get('is_rtl', false) || app()->getLocale() == 'ar' ? 'ph-caret-left' : 'ph-caret-right' }} ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <span class="topbar-divider"></span>

                    <div class="dropdown">
                        <a href="#" id="profileDropdown"
                            class="user-dropdown d-flex align-items-center dropend dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="avatar avatar-md2 flex-shrink-0">
                                @if (!empty(Auth::user()->getRawOriginal('profile')))
                                    <img src="{{ Auth::user()->profile }}" alt="Profile"
                                        class="img-fluid rounded-circle" data-no-auto-error
                                        onerror="onErrorUserAvatar(event)" data-name="{{ Auth::user()->name }}">
                                @elseif(!empty(Auth::user()->name))
                                    <x-avatar-initial :name="Auth::user()->name" :size="40" />
                                @else
                                    <x-avatar-initial :name="''" :size="40" />
                                @endif
                            </div>

                            <!-- Admin name visible on all screens -->
                            <div class="text ms-2">
                                <h6 class="user-dropdown-name mb-0 text-truncate" style="max-width:120px;">
                                    {{ Auth::user()->name }}
                                </h6>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end topbarUserDropdown"
                            aria-labelledby="topbarUserDropdown">
                            <li><a class="dropdown-item" href="{{ route('change-password.index') }}"><i
                                        class="icon-mid bi bi-gear me-2"></i>{{ __('Change Password') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('change-profile.index') }}"><i
                                        class="icon-mid bi bi-person me-2"></i>{{ __('Change Profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }} "
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> {{ __('Logout') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                {{ csrf_field() }}
                            </form>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    {{-- {{ print_r($currentLanguage) }} --}}
</header>
