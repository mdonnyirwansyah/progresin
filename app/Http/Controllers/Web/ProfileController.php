<?php

namespace App\Http\Controllers\Web;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function login(): View
    {
        return view('app.profile');
    }
}
