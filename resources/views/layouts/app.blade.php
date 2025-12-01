<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="M. Donny Irwansyah">
    <title>{{ env('APP_NAME', 'Progresin.id') }} · @yield('title', 'Home')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="{{ asset('assets/img/favicons/safari-pinned-tab.svg') }}" color="#7952b3">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">

    <!-- Theme Color -->
    <meta name="theme-color" content="#7952b3">

    <!-- Assets -->
    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Custom styles for this template -->
    @stack('styles')
</head>

<body>
    {{-- Header --}}
    <header class="navbar navbar-primary sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-white" href="#">{{ env('APP_NAME', 'Progresin.id') }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="w-100"></div>

        <div class="navbar-nav">
            <div class="nav-item text-nowrap d-flex align-items-center gap-3 px-3" style="min-height: 50px;">
                <div class="dropdown">
                    <a href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                       class="d-inline-flex align-items-center text-decoration-none text-light gap-2">
                        <div class="d-flex align-items-center justify-content-center glass-icon-pill"
                             data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ __('Language') }}">
                            🇬🇧
                        </div>
                        <small class="d-inline d-sm-none">{{ __('Language') }}</small>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-sm-end shadow mt-2 position-absolute p-0 glass-dropdown"
                        aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <span class="me-2">🇬🇧</span> <small>{{ __('English') }}</small>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <span class="me-2">🇮🇩</span> <small>{{ __('Indonesian') }}</small>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Notification --}}
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none text-light gap-1"
                       id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="position-relative glass-icon-pill"
                             data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ __('Notification') }}">
                            <i class="fs-5 bi bi-bell"></i>
                            <span class="spinner-grow spinner-grow-sm position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                  style="font-size: 7px; width: fit-content;">
                                <span class="text-black">+99</span> <span class="visually-hidden">{{ __('unread notifications') }}</span>
                            </span>
                        </div>
                        <small class="d-inline d-sm-none ms-1">{{ __('Notifications') }}</small>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-sm-end shadow mt-2 position-absolute p-0 glass-dropdown"
                        aria-labelledby="notificationDropdown" style="width: 260px; max-height: 320px; overflow-y: auto;"
                        data-bs-display="static">
                        <li class="sticky-top glass-dropdown-header">
                            <div class="d-flex align-items-center justify-content-between px-3 py-2">
                                <strong class="small text-light">{{ __('Notifications') }}</strong>
                                <button class="btn btn-sm btn-link text-decoration-none text-accent">
                                    <small>{{ __('Mark all as read') }}</small>
                                </button>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <div class="d-flex">
                                    <div class="me-2 text-accent">
                                        <i class="bi bi-chat-left-text"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="small fw-semibold text-light">New message</div>
                                        <small class="extra-muted">1 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-0 border-glass-soft">
                        </li>
                        <li>
                            <a class="dropdown-item py-2 position-relative" href="#">
                                <div class="d-flex">
                                    <div class="me-2 text-accent">
                                        <i class="bi bi-chat-left-text"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="small fw-semibold text-light">Coming Soon</div>
                                        <small class="extra-muted">5 minutes ago</small>
                                    </div>
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <span class="spinner-grow spinner-grow-sm d-inline-block bg-accent rounded-circle"
                                              style="width: 8px; height: 8px;"></span>
                                    </span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Profile --}}
                <div class="dropdown">
                    @php
                        $user = Auth::user();
                        $initials = strtoupper(substr($user->name, 0, 2));
                        $full_name = explode(" ", $user->name);
                        $last_name = substr(end($full_name), 0, 7);
                        if (strlen($last_name) > 7) {
                            $short_name = substr($last_name, 0, 7) . "...";
                        } else {
                            $short_name = $last_name;
                        }
                    @endphp
                    <a href="#" class="d-flex align-items-center text-decoration-none gap-2 text-light"
                       id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @if($user->avatar ?? false)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar"
                                 class="rounded-circle glass-avatar"
                                 width="30" height="30"
                                 data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ __('Profile') }}">
                        @else
                            <div class="rounded-circle glass-avatar d-flex align-items-center justify-content-center fw-semibold"
                                 style="width: 30px; height: 30px;"
                                 data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ __('Profile') }}">
                                {{ $initials }}
                            </div>
                        @endif
                        <small class="d-inline d-sm-none">{{ $short_name }}</small>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-sm-end shadow mt-2 position-absolute p-0 glass-dropdown"
                        aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person me-2"></i> <small>{{ __('Profile') }}</small>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('password') }}">
                                <i class="bi bi-key me-2"></i> <small>{{ __('Change Password') }}</small>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> <small>{{ __('Logout') }}</small>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-md-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <span data-feather="home"></span>
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('wallet.view') ? 'active' : '' }}" href="{{ route('wallet.view') }}">
                                <span data-feather="credit-card"></span>
                                {{ __('Wallet') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- Main Content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title', 'Home')</h1>
                </div>

                <div style="min-height: 75vh;">
                    @yield('content')
                </div>

                <footer class="ml-sm-auto py-3 py-md-4" style="display: grid;">
                    <div class="py-3 px-3 text-center bg-primary d-flex justify-content-between" style="align-self: end; border-radius: 5px;">
                        <span class="text-white">&copy;{{ date('Y') }} Progresin.id</span> <span class="text-white">{{ __('Version') }} {{ file_get_contents(base_path('version')) }}</span>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <div id="loadingOverlay" class="loading-overlay d-none">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">{{ __('Loading') }}...</span>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="app-toast" class="toast glass-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header glass-toast-header">
                <i id="toast-icon" class="bi bi-info-circle me-2 text-accent"></i>
                <strong id="toast-title" class="me-auto small text-light"></strong>
                <small id="toast-time" class="extra-muted"></small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body small text-light" id="toast-message"></div>
        </div>
    </div>

    <div class="toast-container p-3 position-fixed top-50 start-50 translate-middle">
        <div id="confirm-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header d-flex justify-content-center border-0">
                <i id="confirm-icon" class="bi bi-question-circle fs-1 text-accent"></i>
            </div>
            <div class="toast-body text-center">
                <p id="confirm-message" class="fs-5 fw-semibold mb-3">
                    {{ __('Are you sure?') }}
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" id="confirm-yes" class="btn btn-sm btn-outline-primary">
                        {{ __('Yes') }}
                    </button>
                    <button type="button" id="confirm-no" class="btn btn-sm btn-outline-danger" data-bs-dismiss="toast">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
