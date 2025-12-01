<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;

Route::middleware(['auth', 'auth.session'])
    ->group(function () {
        Route::middleware('verified')
            ->group(function () {
                Route::get('/', function () {
                    return view('app.home');
                })
                    ->name('home');
                Route::get('profile', function () {
                    return view('app.profile');
                })
                    ->name('profile');
                Route::get('password', function () {
                    return view('app.password');
                })
                    ->name('password');
            });
        Route::post('logout', [AuthController::class, 'logout'])
            ->name('logout');
    });
Route::middleware(['guest'])
    ->group(function () {
        Route::prefix('login')
            ->controller(AuthController::class)
            ->group(function () {
                Route::get('', 'login')
                    ->name('login');
                Route::post('', 'loginStore')
                    ->name('login.store');
            });
        Route::prefix('register')
            ->controller(AuthController::class)
            ->group(function () {
                Route::get('', 'register')
                    ->name('register');
                Route::post('', 'registerStore')
                    ->name('register.store');
            });
        Route::prefix('forgot-password')
            ->controller(AuthController::class)
            ->name('password.')
            ->group(function () {
                Route::get('', 'passwordRequest')
                    ->name('request');
                Route::post('', 'passwordEmail')
                    ->name('email');
            });
        Route::prefix('reset-password')
            ->controller(AuthController::class)
            ->name('password.')
            ->group(function () {
                Route::get('', 'passwordReset')
                    ->name('reset');
                Route::post('', 'passwordUpdate')
                    ->name('update');
            });
        Route::prefix('auth/google')
            ->controller(AuthController::class)
            ->group(function () {
                Route::get('', 'google')
                    ->name('google');
                Route::get('callback', 'googleCallback')
                    ->name('google.callback');
            });
    });
Route::prefix('email')
    ->controller(AuthController::class)
    ->middleware('auth')
    ->name('verification.')
    ->group(function () {
        Route::prefix('verify')
            ->group(function () {
                Route::get('', 'verificationNotice')
                    ->name('notice');
                Route::get('{id}/{hash}', 'verificationVerify')
                    ->middleware('signed')
                    ->name('verify');
            });
        Route::post('verification-notification', 'verificationSend')
            ->middleware('throttle:6,1')
            ->name('send');
    });
Route::get('example', function () {
    if (env('APP_ENV') != 'production') {
        return view('example');
    } else {
        abort(403);
    }
})
    ->name('example');
