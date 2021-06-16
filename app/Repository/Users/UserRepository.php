<?php
namespace App\Repository\Users;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    /**
     * @param user ID
     * Authenticate Via User ID
     */
    public static function loginById($user_id)
    {
        Auth::loginUsingId($user_id);

        return Auth::user();
    }

    /**
     * @param User Data
     * Register New User For Social Login
     */
    public static function socialRegister($data)
    {
        $user = new User;
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $user->password = Hash::make(rand(1,10000));
        $user->save();
        Auth::loginUsingId($user->id);

        return Auth::user();
    }

    /**
     * @param Request Data
     * 
     * Register New User Into Our Storage
     */
    public static function register($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'contact_no' => "+".$data['country_code'].$data['contact_no'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_sms_verify' => 1
        ]);

        Auth::loginUsingId($user->id);
    }

}