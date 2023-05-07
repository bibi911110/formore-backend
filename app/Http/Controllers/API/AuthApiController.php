<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use App\Helper\Sms_master;
use Mail,Password;
use App\Mail\ForgetPasswordApiMail;



class AuthApiController extends Controller
{
   public function send_otp(Request $request)
    {
        $rules = [
            'mobile_no' => 'required',
            'email' => 'required',
                       
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(['status'=>'401','Message'=>$validator->errors()]);
        }
        $user_no = User::where('mobile_no',$request->mobile_no)->first();

        $user_email= User::where('email',$request->email)->first();

       
        
        if(!empty($user_no) || !empty($user_email))
        {   
           // echo "string"; 
            if(isset($user_no->mobile_no))
            {
                return response(['status'=>'401','Message'=>"Your mobile number already registered..."]); 
            }
            else if(isset($user_email->email)) 
            {
                return response(['status'=>'401','Message'=>"Your email id already registered..."]); 

            }

        }else
        {
           
            $response = Sms_master::send_sms_token();
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://connect.routee.net/sms",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{ \"body\": \"www.for-more.eu code is: ".$request->otp."\",\"to\" : \"".$request->mobile_code.$request->mobile_no."\",\"from\": \"for-more.eu\"}",
              CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$response,
                "content-type: application/json"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              return response(['status'=>'401','Message'=>"Otp Not Send.",'err' =>$err]);
            } else {
                return response(['status'=>'200','Message'=>'Otp Send Successfully']);
            }   
        }
        
       
    }
    /*Edit code*/
    public function send_mobile_otp(Request $request)
    {
        $rules = [
            'mobile_no' => 'required',
                                 
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(['status'=>'401','Message'=>$validator->errors()]);
        }
        $user_no = User::where('mobile_no',$request->mobile_no)->first();

        
        
        if(!empty($user_no))
        {   
           // echo "string"; 
            if(isset($user_no->mobile_no))
            {
                return response(['status'=>'401','Message'=>"Your mobile number already registered..."]); 
            }
            
        }else
        {
           
            $response = Sms_master::send_sms_token();
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://connect.routee.net/sms",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{ \"body\": \"www.for-more.eu code is: ".$request->otp."\",\"to\" : \"".$request->mobile_code.$request->mobile_no."\",\"from\": \"for-more.eu\"}",
              CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$response,
                "content-type: application/json"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              return response(['status'=>'401','Message'=>"Otp Not Send.",'err' =>$err]);
            } else {
                return response(['status'=>'200','Message'=>'Otp Send Successfully']);
            }   
        }
        
       
    }
    public function register(Request $request){
         $input = $request->all();

        $rules = [
            'lang_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|same:confirm-password',
            
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(['status'=>'401','Message'=>$validator->errors()]);
        }
        $input['name'] = $request->first_name.' '.$request->last_name;
        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['email'] = $request->email;
        $input['role_id'] = '4';
        $input['is_admin'] = '1';
        $input['password'] = bcrypt($request->password);
        $input['show_password'] = $request->password;
        $input['mobile_code'] = $request->mobile_code;
        $unique_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
        $input['unique_no'] =  $unique_code;

/*barcode*/
        $img = 'data:image/png;base64,' . \DNS1D::getBarcodePNG($unique_code, 'C39', true);
        $image = $img;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = $input['first_name'].\Str::random(10).'.'.'png';
        file_put_contents(public_path().'/users/' .$imageName, base64_decode($image));
        $input['bar_code'] = 'public/users/'.$imageName;

/*QRcode*/
        $qr_img = 'data:image/png;base64,' . \DNS2D::getBarcodePNG($unique_code, 'QRCODE');
        $qr_image =$qr_img;
        $qr_image = str_replace('data:image/png;base64,', '', $qr_image);
        $qr_image = str_replace(' ', '+', $qr_image);
        $qr_imageName = $input['first_name'].\Str::random(10).'.'.'png';
        file_put_contents(public_path().'/users_qr/' .$qr_imageName, base64_decode($qr_image));
        $input['qr_code'] = 'public/users_qr/'.$qr_imageName;

        $user = User::create($input);
        
        $user->assignRole(4);
        
        $accessToken = $user->createToken('authToken')->accessToken;

        if($input['voucher_code'])
        {
            //$user = \App\User::where('email',$input['to_email'])->first();
            //$sender = \App\User::where('id',$input['user_id'])->first();
            $voucher_details = \App\Models\Voucher::where('code',$input['voucher_code'])->first();  
            if(!empty($voucher_details))
            {
            $sender = \App\Models\Gift_card::where('voucher_id',$voucher_details->id)->first();

            /* echo "<pre>";
            print_r($sender);
            exit; */

            $input['to_user_id'] = $user->id;
            $input['user_id'] = $sender->user_id;

            $user_voucher['assigned_user_id'] = $user->id;
            $user_voucher['used_code_status'] = 1;
            

            $credit['voucher_id'] = $voucher_details->id;
            $credit['user_id'] = $user->id;
            $credit['used_code_status'] = 0;
            //$credit['assigned_user_id'] = $request->user_id;

            $gift['to_user_id'] = $user->id;

            $userVoucherUpdate = \App\Models\User_voucher::where('user_id',$sender->user_id)->where('voucher_id',$voucher_details->id)->update($user_voucher);
            $userVoucherId = \App\Models\Gift_card::where('user_id',$sender->user_id)->where('voucher_id',$voucher_details->id)->update($gift);
            $userVoucher = \App\Models\User_voucher::create($credit);
            }
            else
            {
                return response(['status'=>'200','Message'=>'User Created but code does not exist.','user'=>$user,'access_token'=>$accessToken]);    
            }
            

        }

       // return response(['user'=>$user,'access_token'=>$accessToken]);   

        if($user != ''){
            return response(['status'=>'200','Message'=>'User Created.','user'=>$user,'access_token'=>$accessToken]);
        }else{
            return response(['status'=>'401','Message'=>"User Not Created."]);
        }  
    }
    public function RegisterToken(Request $request)
    {
        
        $user_token = User::where('id',$request->user_id)->update(['device_token' => $request->device_token]);

        if($user_token != ''){
            return response(['status'=>'200','Message'=>'User Token Updated.']);
        }else{
            return response(['status'=>'401','Message'=>"User Token Not Updated."]);
        } 
    }
    public function user_detils_show(Request $request)
    {
       
        $user = User::where('id',$request->id)->first();
     
                        
        if($user != ''){
            return response(['status'=>'200','Message'=>'User Data Found.','user' => $user]);
        }else{
            return response(['status'=>'401','Message'=>"User Data Not Found"]);
        }
    }
    /*Account setting update*/
    public function account_setting_update(Request $request)
    {
       
        $user = User::where('id',$request->id)
                     ->update([
                        'sex'=> $request->sex,
                        'lang_id'=> $request->lang_id,
                        'city'=> $request->city,
                        'residence_country_id'=> $request->residence_country_id,
                        'marital_status'=> $request->marital_status,
                        'no_kids'=> $request->no_kids,
                        'entartainment'=> $request->entartainment,
                        'travelings'=> $request->travelings,
                        'sports'=> $request->sports,
                        'electronic_games'=> $request->electronic_games,
                        'technolocgy'=> $request->technolocgy,
                        'food'=> $request->food,
                        'music'=> $request->music,
                        'nightlife'=> $request->nightlife,
                        'name' => $request->first_name.' '.$request->last_name,
                        'first_name'=> $request->first_name,
                        'last_name'=> $request->last_name,
                        'mobile_no'=> $request->mobile_no,
                        'mobile_code'=> $request->mobile_code,
                        'password' => bcrypt($request->password),
                        'show_password' => $request->password,
                        ]);
        
        if($user != ''){
            $user_details = User::where('users.id',$request->id)->leftjoin('country','users.residence_country_id','country.id')->select('users.*','country.country_name')->first();;
            return response(['status'=>'200','Message'=>'User Details Updated.','user' => $user_details]);
        }else{
            return response(['status'=>'401','Message'=>"User Details Not Updated"]);
        }  
       
    }


     public function user_detils_update(Request $request)
    {
       
        $user = User::where('id',$request->id)
                     ->update([
                        'birth_date'=> date('Y-m-d',strtotime($request->birth_date)),
                        'sex'=> $request->sex,
                        'city'=> $request->city,
                        'residence_country_id'=> $request->residence_country_id,
                        'marital_status'=> $request->marital_status,
                        'no_kids'=> $request->no_kids,
                        'entartainment'=> $request->entartainment,
                        'travelings'=> $request->travelings,
                        'sports'=> $request->sports,
                        'electronic_games'=> $request->electronic_games,
                        'technolocgy'=> $request->technolocgy,
                        'food'=> $request->food,
                        'music'=> $request->music,
                        'nightlife'=> $request->nightlife,
                        'info'=> $request->info,
                    ]);
        
        if($user != ''){
            $user_details = User::where('users.id',$request->id)->leftjoin('country','users.residence_country_id','country.id')->select('users.*','country.country_name')->first();
            return response(['status'=>'200','Message'=>'User Details Updated.','user' => $user_details]);
        }else{
            return response(['status'=>'401','Message'=>"User Details Not Updated"]);
        }  
       
    }

    public function login(Request $request){

        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['status'=>'401','Message'=>'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $user =  auth()->user();
        $user = User::where('email',$request->email)->where('role_id','4')->leftjoin('country','users.residence_country_id','country.id')->select('users.*','country.country_name')->first();
        if($user['status'] == '1'){
            return response(['status'=>'200','Message'=>'Login Successfully','user'=>$user,'access_token'=>$accessToken]);
        }else{
            return response(['status'=>'401','Message'=>"login Not Successfully."]);
        } 

        //return response(['user'=>auth()->user(),'access_token'=>$accessToken]);
    }

    public function login_buss_user(Request $request){

        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['status'=>'401','Message'=>'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $user =  auth()->user();
        $user_data = User::where('email',$request->email)->where('role_id','5')
                        ->leftjoin('country','users.residence_country_id','country.id')
                        ->leftjoin('brand','users.business_id','brand.id')
                        ->select('users.*','brand.brand_icon','brand.name as business_name','country.country_name')
                        ->first();
        $buss_id = User::where('id',$user_data->business_id)->where('role_id','3')->first();
         $brandName = \App\Models\Brand::where('id',@$buss_id->userDetailsId)->first();
         $stamp_data = \App\Models\Stamp_master::where('business_id',@$buss_id->userDetailsId)->first();
         $buss_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',@$buss_id->userDetailsId)->first();
        $user = array('id' =>  $user_data['id'],
                     'name' =>  $user_data['name'],
                     'lang_id' =>  $user_data['lang_id'],
                     'first_name' =>  $user_data['first_name'],
                     'last_name' =>  $user_data['last_name'],
                     'mobile_no' =>  $user_data['mobile_no'],
                     'mobile_code' =>  $user_data['mobile_code'],
                     'role_id' =>  $user_data['role_id'],
                     'unique_no' =>  $user_data['unique_no'],
                     'info' =>  $user_data['info'],
                     'bar_code' =>  $user_data['bar_code'],
                     'qr_code' =>  $user_data['qr_code'],
                     'email' =>  $user_data['email'],
                     'birth_date' =>  $user_data['birth_date'],
                     'sex' =>  $user_data['sex'],
                     'city' =>  $user_data['city'],
                     'residence_country_id' =>  $user_data['residence_country_id'],
                     'marital_status' =>  $user_data['marital_status'],
                     'no_kids' =>  $user_data['no_kids'],
                     'entartainment' =>  $user_data['entartainment'],
                     'travelings' =>  $user_data['travelings'],
                     'sports' =>  $user_data['sports'],
                     'electronic_games' =>  $user_data['electronic_games'],
                     'technolocgy' =>  $user_data['technolocgy'],
                     'food' =>  $user_data['food'],
                     'music' =>  $user_data['music'],
                     'nightlife' =>  $user_data['nightlife'],
                     'device_token' =>  $user_data['device_token'],
                     'status' =>  $user_data['status'],
                     /*'point' =>  $user_data['point'],
                     'stamp' =>  $user_data['stamp'],*/
                      'stamp' => @$buss_data->total_stamp,
                      'point' => @$buss_data->total_point,
                     'transaction_type' =>  $user_data['transaction_type'],
                     'business_id' =>  $user_data['business_id'],
                     'created_by' =>  $user_data['created_by'],
                     'brand_icon' =>  @$brandName['brand_icon'],
                     'business_name' =>  @$brandName['name'],
                     'country_name' =>  @$user_data['country_name'],
                    );
        if($user_data['status'] == '1'){
            return response(['status'=>'200','Message'=>'Login Successfully','user'=>$user,'access_token'=>$accessToken]);
        }else{
            return response(['status'=>'401','Message'=>"login Not Successfully."]);
        } 

        //return response(['user'=>auth()->user(),'access_token'=>$accessToken]);
    }

    public function forget_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "msg" => "success", "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, 'Fail'=>"Data not Found", "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
    }
}