<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Mail;


class Sms_master
{
    public static function send_sms_token()
    { 

        $clientID = '6226cef9d6eefd0001e5b890';
        $clientSecret ='sPKiGo1Xog';

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://auth.routee.net/oauth/token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "grant_type=client_credentials",
          CURLOPT_HTTPHEADER => array(
            'authorization: Basic '.base64_encode($clientID.':'.$clientSecret),
            "content-type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response);
         return $data->access_token;
        }
    }  

    /*ticket create send email*/ 

    public static function send_email_ticket($user,$otp_data)
    { 
        $user['otp'] =$otp_data['otp']; 

        Mail::send('emails.ticket_api', $user, function($message) use ($user) {
        $message->to($user['email']);
        $message->subject('Ticket Create Otp');
        });
    }     

   
}
