<?php

namespace App\Http\Controllers;

use App\Repository\SocialLoginRepository;
use Exception;
use Socialite;
use Illuminate\Http\Request;
use Session;

class SocialAuthLinkedinController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function callback()
    {
        try {
            SocialLoginRepository::LinkedInLogin();
            return redirect()->route('home');
        } catch (Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return redirect()->route('login');
        }
    }
}
