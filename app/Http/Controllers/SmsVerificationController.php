<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifySmsRequest;
use App\Repository\Twilio;
use App\Repository\Users\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Session;

class SmsVerificationController extends Controller
{
    /**
     * Show Verification Form
     */
    public function showVerificationForm()
    {
        if(!Session::has('user')) {
            return redirect()->route('register');
        }
        return view('auth.verify_sms');
    }
    
    /**
     * @param Illuminate\Http\Request
     * 
     * Verifying Sms Code
     */
    public function verify(VerifySmsRequest $request)
    {
        // dd(Session::get('user'));
        // Validating Token
        if ($request->code != Session::get('user')['verification_code']) {
            Session::flash('error','Invalid Code Try Again');
            return back();
        }
        
        // Register User
        $data = Session::pull('user');
        $data['is_sms_verify'] = 1;
        UserRepository::register($data);

        Session::flash('success','Register Successfully');
        return redirect()->route('home');
    }

    /**
     * Resend Verification Sms
     */
    public function resend()
    {
        try {
            $now = new Carbon();

            // Checking Verification Delay
            if(Session::has('verification_delay') && Session::get('verification_delay') > $now->toDateTimeString()) {
                Session::flash('error','Please Wait few Minute!');
                return back();
            }
            
            // Getting User Data
            $user_data = Session::get('user');
            $contact_no = "+".$user_data['country_code'].$user_data['contact_no'];

            try {
                // Sending Sms
                $verfification_code = Twilio::sendVerificationSms($contact_no);
                $user_data['verification_code'] = $verfification_code;
                // Adding Minute Delay
                $new_time = $now->addMinute()->toDateTimeString();
                Session::put('verification_delay',$new_time);
    
                Session::put('user',$user_data);
                Session::flash('success','Sms Send to your Phone No');
                return back();
            } catch (Exception $ex) {
                Session::put('error','Unable To Send Message Please try again!');
                return back();
            }



        } catch (Exception $ex) {
            Session::flash('error',$ex->getMessage());
            return back();
        }
    }

}
