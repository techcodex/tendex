<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Http\Requests\VerifySmsRequest;
use Session;
use App\Repository\Twilio;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserSmsVerificationController extends Controller
{
    /**
     * Show Contact Form to Verify Contact No
     */
    public function showContactNoForm()
    {
        $data = [
            'page_heading' => 'Verify Contact No',
            'countries' => Country::orderBy('name','asc')->get()
        ];
        return view('users.verify_contact_form')->with($data);
    }
    /**
     * @param Illuminate\Http\Request
     * Sending Verification Code to User Contact No
     */
    public function sendVerificationSms(Request $request)
    {
        // Validating Request param
        $request->validate([
            'country_code' => 'required',
            'contact_no' => 'required|min:10|max:11',
        ]);
        
        $contact_no = "+".$request->country_code.$request->contact_no;

        // Sending sms
        try {
            $verification_code = Twilio::sendVerificationSms($contact_no);
        } catch (Exception $ex) {
            Session::flash('error','Unable to Send Message Please try Again!');
            return back();
        }

        
        $request->request->set('verification_code',$verification_code);
        Session::put('user',$request->all());

        Session::flash('success','A Verification Code is send to your Number');

        $data = [
            'page_heading' => 'Verify your Contact No',
        ];
        return redirect()->route('user.verifyForm')->with($data);
    }
    
    /**
     * 
     * Show Resource to user
     */
    public function showVerificationForm() {
        $data = [
            'page_heading' => 'User Contact No Verification'
        ];
        return view('users.verify_contact')->with($data);
    }

    /**
     * @param Illuminate\Http\Reuqest
     * 
     * Verifying Authenticated User Contact No
     */
    public function verify(VerifySmsRequest $request)
    {
        // dd($request->all());
        if (!Session::has('user')) {
            Session::flash('Opps Something Went Wrong Try Again Later');
            return redirect()->route('home');
        }

        $user_data = Session::pull('user');

        // Validating Verification Token
        if ($user_data['verification_code'] != $request->code) {
            Session::flash('error','Invalid Code Try Again');
            return back();
        }

        // Getting Authenticated User
        $user = Auth::user();
        $user->contact_no = $user_data['contact_no'];
        $user->is_sms_verify = 1;
        $user->save();

        Session::flash('success','Contact No Verified Successfully');
        return redirect()->route('home');
    }
}
