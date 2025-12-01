@extends('layouts.app')

@section('title', __('Profile'))

@pushOnce('scripts')
<script>
    @php $userName = auth()->user()->name ?? ''; @endphp

    const currentUserName = @json($userName)

    function getInitials(name) {
        if (!name) return ''
        const parts = name.trim().split(/\s+/)
        if (parts.length === 1) {
            return parts[0].slice(0,2).toUpperCase()
        }
        return (parts[0][0] + parts[parts.length-1][0]).toUpperCase()
    }

    function stringToColor(str) {
        let hash = 0
        for (let i = 0; i < str.length; i++) {
            hash = str.charCodeAt(i) + ((hash << 5) - hash)
        }
        const c = (hash & 0x00FFFFFF)
            .toString(16)
            .toUpperCase()
        return "#" + "00000".substring(0, 6 - c.length) + c
    }

    function initialsDataUrl(name, size = 140) {
        const initials = getInitials(name) || '?'
        const fg = '#FFFFFF'

        const canvas = document.createElement('canvas')
        canvas.width = canvas.height = size
        const ctx = canvas.getContext('2d')

        ctx.fillStyle = 'rgb(33, 37, 41)'
        ctx.fillRect(0, 0, size, size)

        const fontSize = Math.floor(size * 0.45)
        ctx.font = `bold ${fontSize}px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial`
        ctx.fillStyle = fg
        ctx.textAlign = 'center'
        ctx.textBaseline = 'middle'
        ctx.fillText(initials, size / 2, size / 2)

        return canvas.toDataURL('image/png')
    }

    function setAvatarToInitials(previewId = 'avatarPreview', name = currentUserName, size = 140) {
        const preview = document.getElementById(previewId)
        if (!preview) return
        preview.src = initialsDataUrl(name, size)
        preview.style.objectFit = 'cover'
    }

    function removeAvatarPreview() {
        const preview = document.getElementById('avatarPreview')
        const input = document.getElementById('avatarInput')

        if (input) {
            try {
                input.value = null
            } catch (e) {
            }
        }

        setAvatarToInitials('avatarPreview', currentUserName, 140)
    }

    document.addEventListener('DOMContentLoaded', function () {
        const preview = document.getElementById('avatarPreview')
        if (!preview) return

        const src = preview.getAttribute('src') || ''
        const isPlaceholder = src === '' || src.includes('avatar-placeholder') || src.includes('placeholder')
        if (isPlaceholder) {
            setAvatarToInitials('avatarPreview', currentUserName, Math.max(preview.clientWidth, 140))
        }
    })

    function previewAvatar(input, previewId = 'avatarPreview') {
        const preview = document.getElementById(previewId)
        if (input.files && input.files[0]) {
            const reader = new FileReader()
            reader.onload = function (e) {
                preview.src = e.target.result
            }
            reader.readAsDataURL(input.files[0])
        }
    }

    function togglePassword(id, btn) {
        const input = document.getElementById(id)
        const icon = btn.querySelector('i')
        if (!input) return
        if (input.type === 'password') {
            input.type = 'text'
            if (icon) icon.classList.replace('bi-eye-slash', 'bi-eye')
        } else {
            input.type = 'password'
            if (icon) icon.classList.replace('bi-eye', 'bi-eye-slash')
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

    <div class="row g-4">
        <div class="col-md-4 text-center">
            <div class="mb-3">
                @php
                use Illuminate\Support\Facades\Storage;

                $user = auth()->user();
                $name = trim($user->name ?? '');
                $avatarPath = $user->avatar ?? null;

                $avatarUrl = null;
                if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
                    $avatarUrl = asset('storage/' . $avatarPath);
                } else {
                    $parts = preg_split('/\s+/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    if (!$parts) {
                        $initials = '?';
                    } elseif (count($parts) === 1) {
                        $initials = mb_strtoupper(mb_substr($parts[0], 0, 2));
                    } else {
                        $initials = mb_strtoupper(mb_substr($parts[0], 0, 1) . mb_substr(end($parts), 0, 1));
                    }

                    $hash = crc32($name ?: 'user');
                    $fg = '#FFFFFF';

                    $size = 140;
                    $fontSize = (int)($size * 0.45);

                    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='{$size}' height='{$size}'>
                        <rect width='100%' height='100%' />
                        <text x='50%' y='50%' dy='0.35em' text-anchor='middle' fill='{$fg}'
                            font-family='-apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial'
                            font-weight='700' font-size='{$fontSize}'>{$initials}</text>
                    </svg>";

                    $avatarUrl = 'data:image/svg+xml;base64,' . base64_encode($svg);
                }
                @endphp

                <div class="rounded-circle overflow-hidden d-inline-block bg-dark" style="width:140px; height:140px;">
                    <img id="avatarPreview"
                        src="{{ $avatarUrl }}"
                        alt="avatar"
                        class="img-fluid"
                        style="object-fit:cover; width:100%; height:100%;">
                </div>
            </div>

            <form method="post" action="#" enctype="multipart/form-data" id="avatarForm">
                @csrf
                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="form-control form-control-sm mb-2" style="width:100%; display:block;" onchange="previewAvatar(this, 'avatarPreview')">
                <div class="row">
                    <div class="col-6 d-grid gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">Upload Avatar</button>
                    </div>
                    <div class="col-6 d-grid gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="removeAvatarPreview()">Remove Preview</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-8">
            <form method="post" action="#">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            <label for="name">{{ __('Name') }}</label>
                            @error('name') <div class="invalid-feedback text-start">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" disabled>
                            <label for="email">{{ __('Email address') }}</label>
                            @error('email') <div class="invalid-feedback text-start">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
            </form>
        </div>
    </div>
@endsection
