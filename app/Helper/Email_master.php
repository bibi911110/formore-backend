<?php



namespace App\Helper;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Log;

use Mail;





class Email_master

{

    public static function send_email($user)

    { 

        $user_data = \App\User::where('email',$user['your_email'])->select('name','email')->first();

        $user['y_name'] = $user_data['name'];

        $user['y_email'] = $user_data['email'];

        Mail::send('emails.business_refer', $user, function($message) use ($user) {

        $message->to($user['owner_email']);

        $message->subject('Refer a business for join');

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

    public static function send_invitation($user)

    { 

        Mail::send('emails.invitation', $user, function($message) use ($user) {

        $message->to($user['email']);

        $message->subject('ForMor Invitation');

        });

    }   

}

