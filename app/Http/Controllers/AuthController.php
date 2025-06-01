<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {
        return Inertia::render('Auth/Login');
    }

    public function showSignupForm() {
        return Inertia::render('Auth/Register');
    }
}
