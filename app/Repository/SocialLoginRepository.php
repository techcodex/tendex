<?php
namespace App\Repository;

use App\Repository\Users\UserRepository;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class SocialLoginRepository {
    /**
     * Login Via Linkedin
     */
    public static function LinkedInLogin()
    {
        try {
            // Getting Linkedin User Data
            $linkdin_user = Socialite::driver('linkedin')->user();
            $user = User::where('email',$linkdin_user->email)->first();

            $user != "" ? UserRepository::loginById($user->id) : UserRepository::socialRegister($linkdin_user);
        } 
        catch (Exception $e) {
            throw new Exception("Opps Something Went Wrong Try Again");
        }
    }
}