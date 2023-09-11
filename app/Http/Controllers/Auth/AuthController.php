<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

/**
 * AuthController
 * 
 * Controller responsible for Authentication on frontend end
 */
class AuthController extends Controller{

    /**
     * This function will open login form
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * This function will open register form
     */
    public function register()
    {
        return view('auth.register');
    }

}