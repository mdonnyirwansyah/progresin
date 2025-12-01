<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\Web\Auth\RegisterRequest;
use App\Http\Requests\Web\Auth\PasswordEmailRequest;
use App\Http\Requests\Web\Auth\PasswordUpdateRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function loginStore(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->safe()->except(['remember_me']), $request->safe()->only(['remember_me']) == 1 ? true : false)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => __('The provided credentials do not match our records.'),
        ])->onlyInput('email');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function registerStore(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended('/');
    }

    public function verificationNotice(): View
    {
        return view('auth.verify-email');
    }

    public function verificationVerify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->intended('/');
    }

    public function verificationSend(Request $request): RedirectResponse
    {
        $request->user()
            ->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function passwordRequest(): View
    {
        return view('auth.forgot-password');
    }

    public function passwordEmail(PasswordEmailRequest $request): RedirectResponse
    {
        if (User::where('email', $request->email)->exists()) {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::ResetLinkSent
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }

        return back()->withErrors([
            'email' => __('The provided credentials do not match our records.'),
        ])->onlyInput('email');
    }

    public function passwordReset(Request $request): View
    {
        return view('auth.reset-password', ['token' => $request->token, 'email' => $request->email]);
    }

    public function passwordUpdate(PasswordUpdateRequest $request): RedirectResponse
    {
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function google(): RedirectResponse
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function googleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        $user = User::where('email', $googleUser->getEmail())
            ->first();
        if ($user && !$user->google_id) {
            $user->update([
                'google_id' => $googleUser->getId(),
            ]);
        } elseif (!$user) {
            $avatarContents = Http::get($googleUser->getAvatar())
                ->body();

            $filename = 'img/avatars/' . $googleUser->getEmail() . '.jpg';

            Storage::disk('public')
                ->delete($filename);

            Storage::disk('public')
                ->put($filename, $avatarContents);

            $user = User::create([
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now()->format('Y-m-d H:i:s'),
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $filename,
            ]);
        }

        Auth::login($user);

        return redirect()->intended('/');
    }
}
