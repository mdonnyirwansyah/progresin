@extends('layouts.guest')

@section('title', __('Forgot Password'))

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
            margin-bottom: 10px;
        }
    </style>
@endPushOnce

@section('content')
    <main class="form-signin text-center">
        <img class="mb-4" src="{{ asset('assets/brand.svg') }}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">{{ __('Forgot Password') }}</h1>

        <form method="post" action="{{ route('password.email') }}">
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
            <button class="w-100 btn btn-lg btn-primary mt-2" type="submit" onclick="window.showLoading()">{{ __('Send Password Reset Link') }}</button>
            <a class="w-100 btn btn-lg btn-default mt-2" href="{{ route('login') }}" onclick="window.showLoading()">{{ __('Back to Login') }}</a>
            <p class="mt-5 mb-3 text-muted">&copy;{{ date('Y') }} Progresin.id</p>
        </form>
    </main>
@endsection
