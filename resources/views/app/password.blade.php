@extends('layouts.app')

@section('title', __('Change Password'))

@pushOnce('scripts')
<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (!input) return;
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            if (icon) icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }
</script>
@endPushOnce

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="post" action="#">
        @csrf
        @method('PUT')

        <div class="form-floating mb-3 position-relative">
            <input type="password" name="current_password" id="currentPassword"
                    class="form-control @error('current_password') is-invalid @enderror" placeholder="Current Password">
            <label for="currentPassword">{{ __('Current Password') }}</label>
            <button type="button" class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y me-2 p-0"
                    onclick="togglePassword('currentPassword', this)">
                <i class="bi bi-eye-slash"></i>
            </button>
            @error('current_password') <div class="invalid-feedback text-start">{{ $message }}</div> @enderror
        </div>

        <div class="form-floating mb-3 position-relative">
            <input type="password" name="password" id="newPassword"
                    class="form-control @error('password') is-invalid @enderror" placeholder="New Password">
            <label for="newPassword">{{ __('New Password') }}</label>
            <button type="button" class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y me-2 p-0"
                    onclick="togglePassword('newPassword', this)">
                <i class="bi bi-eye-slash"></i>
            </button>
            @error('password') <div class="invalid-feedback text-start">{{ $message }}</div> @enderror
        </div>

        <div class="form-floating mb-3 position-relative">
            <input type="password" name="password_confirmation" id="confirmNewPassword" class="form-control" placeholder="Confirm Password">
            <label for="confirmNewPassword">{{ __('Confirm Password') }}</label>
            <button type="button" class="btn btn-link text-secondary position-absolute top-50 end-0 translate-middle-y me-2 p-0"
                    onclick="togglePassword('confirmNewPassword', this)">
                <i class="bi bi-eye-slash"></i>
            </button>
        </div>

        <button type="submit" class="btn btn-danger">{{ __('Change Password') }}</button>
    </form>
@endsection
