@extends('layouts.guest')

@section('title', __('Login'))

@pushOnce('styles')
    <style>
        body {
            display: flex;
            align-items: center;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[name="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[name="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endPushOnce

@pushOnce('scripts')
    <script>
        function togglePassword(id, button) {
            const input = document.getElementById(id);
            const icon = button.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>
@endPushOnce

@section('content')
    <main class="form-signin text-center">
        <img class="mb-4" src="{{ asset('assets/brand.svg') }}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">{{ __('Login') }}</h1>

        <a href="{{ route('google') }}" class="w-100 btn btn-lg btn-outline-default border" type="button" onclick="window.showLoading()">
            <i class="bi bi-google"></i>
        </a>

        <div class="d-flex align-items-center">
            <hr class="flex-grow-1">
            <span class="mx-2 text-muted fw-bold">{{ __('or') }}</span>
            <hr class="flex-grow-1">
        </div>

        <form method="post" action="{{ route('login.store') }}">
            @csrf

            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') ?? '' }}">
                <label for="floatingInput">{{ __('Email address') }}</label>
            </div>
            <div class="form-floating position-relative">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">{{ __('Password') }}</label>
                <button type="button" class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y me-2 p-0"
                        onclick="togglePassword('floatingPassword', this)">
                    <i class="bi bi-eye-slash" id="icon-floatingPassword"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: left;">
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" name="remember_me" onchange="this.value = this.checked ? 1 : 0" value="{{ old('remember_me') ?? '' }}" {{ old('remember_me') && old('remember_me') == 1 ? 'checked' : '' }}> {{ __('Remember me') }}
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <p style="text-align: right;"><a href="{{ route('password.request') }}" class="link-primary">{{ __('Forgot password?') }}</a></p>
                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" onclick="window.showLoading()">{{ __('Login') }}</button>
            <p class="mt-3 mb-3">{{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="link-primary">{{ __('Sign Up') }}</a></p>
            <p class="mt-5 mb-3 text-muted">&copy;{{ date('Y') }} Progresin.id</p>
        </form>
    </main>
@endsection
