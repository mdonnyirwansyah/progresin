@extends('layouts.guest')

@section('title', __('Reset Password'))

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
            margin-bottom: -1px;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[name="password_confirmation"] {
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
        <h1 class="h3 mb-3 fw-normal">{{ __('Reset Password') }}</h1>

        <form method="post" action="{{ route('password.update') }}">
            @csrf

            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ $email ?? old('email') ?? '' }}" readonly>
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
            <div class="form-floating position-relative">
                <input type="password" name="password_confirmation" class="form-control" id="floatingConfirmPassword" placeholder="Confirm Password">
                <label for="floatingConfirmPassword">{{ __('Confirm Password') }}</label>
                <button type="button" class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y me-2 p-0"
                        onclick="togglePassword('floatingConfirmPassword', this)">
                    <i class="bi bi-eye-slash" id="icon-floatingConfirmPassword"></i>
                </button>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" onclick="window.showLoading()">{{ __('Reset Password') }}</button>
            <p class="mt-5 mb-3 text-muted">&copy;{{ date('Y') }} Progresin.id</p>
        </form>
    </main>
@endsection
