<?php
namespace App\Repository;

use App\User;
use Exception;
use Twilio\Rest\Client;
use Session;

class Twilio {
    /**
     * @param User Contact No;
     * Send Verification SMS
     */
    public static function sendVerificationSms($contact_no)
    {
        try {
            // Getting Twilio Credentials
            $account_sid = config('twilio.twilio_sid');
            $auth_token = config('twilio.twilio_token');
            $twilio_number = config('twilio.twilio_from');

            // Generating Random Number
            $random_number = random_int(100000, 999999);
            $message = "Your Tendex Account Verification Code is ".$random_number;

            // Sending Message
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($contact_no, 
            [
                'from' => $twilio_number, 
                'body' => $message 
            ]);
  
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        
        return $random_number;
    }
}