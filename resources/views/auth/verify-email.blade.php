@extends('layouts.guest')

@section('title', __('Verify Email'))

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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 text-center">
                        <i class="bi bi-envelope-check fs-1 text-primary mb-3"></i>
                        <h4 class="mb-3">{{ __('Verify Your Email Address') }}</h4>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="text-muted mb-4">
                            {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                            {{ __('If you did not receive the email, click the button below to request another one.') }}
                        </p>

                        <form method="post" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mb-3" onclick="window.showLoading()">
                                <i class="bi bi-arrow-repeat me-1"></i> {{ __('Resend Verification Email') }}
                            </button>
                        </form>

                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary w-100" onclick="window.showLoading()">
                                <i class="bi bi-box-arrow-right me-1"></i> {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
