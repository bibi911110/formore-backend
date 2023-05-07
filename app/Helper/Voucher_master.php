<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Mail;


class Voucher_master
{
    public static function send_email($user)
    { 
        
        Mail::send('emails.gift_voucher', $user, function($message) use ($user) {
        $message->to($user['to_email']);
        $message->subject('Gift Voucher');
        });
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
