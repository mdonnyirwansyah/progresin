<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="M. Donny Irwansyah">
    <title>{{ env('APP_NAME', 'Progresin.id') }} · @yield('title', 'Login')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="{{ asset('assets/img/favicons/safari-pinned-tab.svg') }}" color="#7952b3">
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">

    <!-- Theme Color -->
    <meta name="theme-color" content="#7952b3">

    <style>
        html,
        body {
            height: 100%;
        }
        body {
            padding: 40px;
            background-color: #f5f5f5;
        }
    </style>

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom styles for this template -->
    @stack('styles')
</head>

<body>
    @yield('content')

    <div id="loadingOverlay" class="loading-overlay d-none">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">{{ __('Loading') }}...</span>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
