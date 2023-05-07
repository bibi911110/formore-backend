<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\API\CreateBrandAPIRequest;
use App\Http\Requests\API\UpdateBrandAPIRequest;
use App\Models\Brand;
use App\User;
use App\Repositories\BrandRepository;
use App\Models\User_voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BrandResource;
use Response;
use DB;
use App\Helper\Email_master;
use Carbon\Carbon;
use App\Models\Booked_services;
/**
 * Class BrandController
 * @package App\Http\Controllers\API
 */

class BusinessAPIController extends AppBaseController

{

    /** @var  BrandRepository */

    private $brandRepository;
    public function __construct(BrandRepository $brandRepo)

    {
        $this->brandRepository = $brandRepo;
    }
    

    public function index(Request $request)
    {
        $brands = Brand::where('brand.status',1)
                ->leftjoin('users','brand.id','users.userDetailsId')
                ->where('users.user_type',3)
                ->where('users.role_id',3)
                ->select('brand.*','users.id as user_id')
                ->get();
            $brands_data = $brands;
            $count = 0;
            foreach ($brands_data as $value) {
                $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)
                                                 ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')
                                                 ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')
                                                 ->groupBy('category.id')
                                                 ->get();

                $sub_category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)
                                                 ->leftjoin('sub_category','bussiness_cat_subcat_mapping.sub_cat_id','sub_category.id')
                                                 ->select('sub_category.id as subCatId','sub_category.name as sub_name','sub_category.icon as sub_icon')
                                                 ->get();

                $brands_data[$count] = $value;
                $brands_data[$count]['category'] = $category;
                $brands_data[$count]['sub_category'] = $sub_category;
                $count++;
            }
        if($brands != ''){
            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }
    }
    public function findMemberDetails(Request $request)
    {
        $userDetails1 = \App\User::where('unique_no',$request->unique_no)->get();
        
        /*echo "<pre>";
        print($userDetails1[0]); exit;*/
        $buss_id = User::where('id',@$userDetails1[0]->business_id)->where('role_id','3')->first();
       /* echo "<pre>";
        print_r($userDetails1[0]->id); exit;*/
        $total_stmp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',@$buss_id->userDetailsId)
                                                        ->where('user_id',@$userDetails1[0]->id)
                                                        ->select('total_stamp','total_point')
                                                        ->first();;


        $userDetails = '';
        foreach ($userDetails1 as  $value) {
            $userDetails = array('id' => $value->id,
                                 'name' => $value->name,
                                 'lang_id' => $value->lang_id,
                                 'first_name' => $value->first_name,
                                 'last_name' => $value->last_name,
                                 'mobile_no' => $value->mobile_no,
                                 'mobile_code' => $value->mobile_code,
                                 'role_id' => $value->role_id,
                                 'user_type' => $value->user_type,
                                 'userDetailsId' => $value->userDetailsId,
                                 'unique_no' => $value->unique_no,
                                 'info' => $value->info,
                                 'bar_code' => $value->bar_code,
                                 'qr_code' => $value->qr_code,
                                 'email' => $value->email,
                                 'birth_date' => $value->birth_date,
                                 'sex' => $value->sex,
                                 'city' => $value->city,
                                 'residence_country_id' => $value->residence_country_id,
                                 'marital_status' => $value->marital_status,
                                 'no_kids' => $value->no_kids,
                                 'entartainment' => $value->entartainment,
                                 'travelings' => $value->travelings,
                                 'sports' => $value->sports,
                                 'electronic_games' => $value->electronic_games,
                                 'technolocgy' => $value->technolocgy,
                                 'food' => $value->food,
                                 'music' => $value->music,
                                 'nightlife' => $value->nightlife,
                                 'is_admin' => $value->is_admin,
                                 'email_verified_at' => $value->email_verified_at,
                                 'show_password' => $value->show_password,
                                 'device_token' => $value->device_token,
                                 'status' => $value->status,
                                 'point' => (isset($total_stmp_point->total_point))? $total_stmp_point->total_point : 0,
                                 'stamp' => (isset($total_stmp_point->total_stamp))? $total_stmp_point->total_stamp : 0,
                                 'transaction_type' => $value->transaction_type,
                                 'business_id' => $value->business_id,
                                 'created_by' => $value->created_by,
                                 'created_at' => $value->created_at,
                                 'updated_at' => $value->updated_at,
                                 'deleted_at' => $value->deleted_at,
                                );
        }

        if($userDetails != ''){
            return response(['status'=>'200','Message'=>'User retrieved successfully.','user' => $userDetails]);
        }else{
            return response(['status'=>'401','Message'=>"User Not Found"]);
        }
    }
    public function get_member_voucher(Request $request)
    {
        
        //$buss_id = User::where('id',$request->business_id)->first();

        $memberVoucher = User_voucher::where('user_id',$request->user_id)
        ->leftjoin('voucher','user_wallet.voucher_id','voucher.id')
        ->where('voucher.business_id',$request->business_id)
        ->where('user_wallet.used_code_status',0)
        ->select('voucher.*')
        ->get();

        if($memberVoucher != ''){
            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','memberVoucher' => $memberVoucher]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }
    }

    public function rewards_details(Request $request)
    {

            $buss_id = User::where('id',$request->business_id)->where('role_id','3')->first();
            $business_details = \App\Models\Brand::where('id',$buss_id->userDetailsId)->first();    

            $business_stamp = \App\Models\Stamp_master::where('business_id',$buss_id->userDetailsId)->first();
            $business_point = \App\Models\Points_master::where('business_id',$buss_id->userDetailsId)->first();
            if(isset($business_point->id) && $business_point->id != '')
            {


            $points_segment = \App\Models\Points_segment::where('point_id',$business_point->id)->first();
            $flag_selection1 = \App\Models\Flag_selection::where('segment_id',$points_segment->segments_id)
                                                        //->select('points_segment.amount')
                                                        ->first();
            $flag_selection = \App\Models\Points_segment::where('segments_id',$flag_selection1->segment_id)
                                                        ->select('segments_id','amount')
                                                        ->first();
            
            }
            else
            {
                $flag_selection = "1";
            }
            $user_details = User::where('id',$request->user_id)->first();

            $user_wallet = User_voucher::where('user_id',$request->user_id)->first();

        if($flag_selection != ''){
            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','business_details' =>$business_details,'business_stamp' =>$business_stamp,"business_point" => $business_point,'user_wallet' => $user_wallet,'user_details'=>$user_details, 'flag_selection' => $flag_selection]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }
    }

    public function rewards_submit(Request $request)
    {
        //echo Auth::user()->business_id; exit;
        if($request->stamp_point == 1)
        {
            $oldPoint = User::where('id',$request->user_id)->first();
            

            $input['point'] = $request->points + $oldPoint->point;
            $input['stamp'] = $request->stamp + $oldPoint->stamp;
            $input['transaction_type'] = $request->transaction_type;
            $input['business_id'] = $request->business_id;

            $input1['user_id'] = $request->user_id;
            $input1['buss_id'] = $request->business_id;
            $input1['transaction_type_id'] = $request->transaction_type;
            $input1['old_point'] = $oldPoint->point;
            $input1['current_point'] = $request->points + $oldPoint->point;
            $input1['type'] = '1';

            $transaction_history = \App\Models\Transaction_history::create($input1);
            $buss_id = User::where('id',$request->business_id)->where('role_id','3')->first();
            $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id->userDetailsId)->where('user_id',$request->user_id)->first();


            if(empty($bussiness_wise_stamp_point))
            { 
                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $request->business_id;
                $total_data['total_stamp'] = $request->stamp;
                $total_data['total_point'] = $request->points;
                $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
            }else{
               // echo $bussiness_wise_stamp_point->total_stamp; exit;
                $buss_id = User::where('id',$request->business_id)->where('role_id','3')->first();
                $old_stamp = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id->userDetailsId)->where('user_id',$request->user_id)->first();
                $business_stamp = \App\Models\Stamp_master::where('business_id',$buss_id->userDetailsId)->first();

                 if($old_stamp->total_stamp < $business_stamp->setup_level)
                {
                    $input['stamp'] =$request->stamp +$bussiness_wise_stamp_point->total_stamp;              
                   
                }else{
                    $input['stamp'] = 1;
                }
                $total_data['user_id'] =$request->user_id;
                $total_data['business_id'] = $buss_id->userDetailsId;
                $total_data['total_stamp'] = $input['stamp'];
                $total_data['total_point'] = $request->points + $bussiness_wise_stamp_point->total_point ;
                //echo 'pre>'; print_r($total_data); exit;
                $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id->userDetailsId)->update($total_data);

            }

            $update = User::where('id',$request->user_id)->update($input);

            //Flash::success('Stamps and Points credited successfully in your rewards.');
            return response(['status'=>'200','Message'=>'Stamps and Points credited successfully in your rewards.']);
            //return redirect(route('findMember'));
            //$category = $this->categoryRepository->update($input, $id);
        }
        else
        {
            
            $oldPoint = User::where('id',$request->user_id)->first();

            $input['point'] = $request->points + $oldPoint->point;
            $input['transaction_type'] = $request->transaction_type;
            $input['business_id'] = $request->business_id;

            $input1['user_id'] = $request->user_id;
            $input1['buss_id'] = $request->business_id;
            $input1['transaction_type_id'] = $request->transaction_type;
            $input1['old_point'] = $oldPoint->point;
            $input1['current_point'] = $request->points + $oldPoint->point;
            $input1['type'] = '1';

           // $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$request->business_id)->first();
             $user_buss_id = \App\User::where('id',$request->business_id)->first();
             
          /*  echo "<pre>";
            print_r($user_buss_id->userDetailsId); exit;*/

            $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$user_buss_id->userDetailsId)
                                                                                ->where('user_id',$request->user_id)
                                                                                ->first();
           /* if(empty($bussiness_wise_stamp_point))
            { 
                $total_data['user_id'] = $request->user_id;
                $buss_id = User::where('id',$request->business_id)->where('role_id','3')->first();
                $total_data['user_id'] =$request->user_id;
                //$total_data['total_stamp'] = $request->stamp;
                $total_data['total_point'] = $request->points;
                $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
            }else{

                $total_data['user_id'] = $request->user_id;
                $buss_id = User::where('id',$request->business_id)->where('role_id','3')->first();
                $total_data['user_id'] =$request->user_id;
               // $total_data['total_stamp'] = $request->stamp;
                $total_data['total_point'] = $request->points + $bussiness_wise_stamp_point->total_point ;
                $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$request->business_id)->update($total_data);

            }*/

             if(empty($bussiness_wise_stamp_point))
            { 
                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $user_buss_id->userDetailsId;
                $total_data['total_point'] = $request->points;
                
                $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
            }else{

                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $user_buss_id->userDetailsId;
                $total_data['total_point'] = $request->points + $bussiness_wise_stamp_point->total_point;
                $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$user_buss_id->userDetailsId)
                                                                                ->where('user_id',$request->user_id)->update($total_data);

            }

            $transaction_history = \App\Models\Transaction_history::create($input1);

            $update = User::where('id',$request->user_id)->update($input);
            return response(['status'=>'200','Message'=>'Points credited successfully in your rewards.']);
            /*Flash::success('Points credited successfully in your rewards.');
            return redirect(route('findMember'));*/

        }
        
    }

    public function credit_member_voucher(Request $request)
    {
        $input['used_code_status'] = 1;
        
        $update = User_voucher::where('user_id',$request->user_id)->where('voucher_id',$request->voucher_id)->update($input);
        //Flash::success('Member voucher has been used and debited from your wallet.');
        return response(['status'=>'200','Message'=>'Member voucher has been used and debited from your wallet.']);
        //return redirect(route('findMember'));
    }

    public function get_give_voucher(Request $request)
    {
        /*echo "<pre>";
        print_r($request->all());
        exit;*/
        $vouchers = \App\Models\Voucher::where('business_id',$request->business_id)->where('category_id','1')->where('code_status',0)->get();
        
        $user_details = User::where('id',$request->user_id)->first();
        if($vouchers != ''){
            return response(['status'=>'200','Message'=>'Voucher retrieved successfully.','vouchers' =>$vouchers,'user_details' => $user_details]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }
    }

    public function post_give_voucher(Request $request)
    {
        
        $voucher_details = \App\Models\Voucher::where('id',$request->voucher_id)->where('code',$request->voucher_code)->first();


        $dateData1 = \Carbon\Carbon::instance($voucher_details->start_date);
        $startDate =  \Carbon\Carbon::parse($dateData1)->format('Y-m-d');
    
        $dateData = \Carbon\Carbon::instance($voucher_details->end_date);
        $endDate =  \Carbon\Carbon::parse($dateData)->format('Y-m-d');
        if(!empty($voucher_details))
        {
            $todayDate = date('Y-m-d');
                if(!empty($voucher_details) && $voucher_details->code === $request['voucher_code'])
                {
                    if($todayDate >= $startDate )
                    {
                        if($todayDate <= $endDate )
                        {
                            if($voucher_details->code_status == '0' )
                            {   
                                $input['voucher_id'] = $voucher_details->id;
                                $input['used_code_status'] = 1;
                                //$input['voucher_id'] = $voucher_details->id;
                                $input['user_id'] = $request->user_id;
                                //$userVoucher = $this->userVoucherRepository->create($input);
                                $userVoucher = User_voucher::create($input);
                                //$data['voucher_id'] = $voucher_details->id;
                                $data['code_status'] = 1;

                                $voucherUpdate = \App\Models\Voucher::where('id',$voucher_details->id)->update($data);

                                $firebaseToken = \App\User::where('id',$request->user_id)->where('users.role_id',4)->whereNotNull('device_token')->pluck('device_token')->all();

                                $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 
                                $data = [
                                    "registration_ids" => $firebaseToken,
                                    "notification" => [
                                        "title" => "New Voucher Credited",
                                        //"body" => "Rating",
                                    ],
                                    "data" => [
                                        "type" => "Voucher Credited",
                                    ]                     
                                ];
                                $dataString = json_encode($data);  
                                $headers = [
                                    'Authorization: key=' . $SERVER_API_KEY,
                                    'Content-Type: application/json',
                                ];
                                $ch = curl_init();    
                                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                                $response = curl_exec($ch);
                                $data = json_decode($response);

                                return response(['status'=>'200','Message'=>'Voucher has been credited successfully in your wallet.']);
                                
                            }
                            else
                            {
                                
                                return response(['status'=>'200','Message'=>'Voucher is already used']);
                            }
                        }    
                        else
                        {
                            return response(['status'=>'200','Message'=>'Voucher Expired']);
                        }
                    }
                    else
                    {
                        return response(['status'=>'200','Message'=>"Voucher Doesn't Start Yet"]);
                    }
                }
                else
                {            
                    return response(['status'=>'200','Message'=>"the code doesn't exist"]);
                }
            
        }
        else
        {
            
            return response(['status'=>'200','Message'=>"Voucher Does not exist"]);
        }
    }

    public function cash_back(Request $request)
    {

        $user_details = User::where('id',$request->user_id)->first();
        $buss_id = User::where('id',$request->business_id)->first();
        $business_point = \App\Models\Points_master::where('business_id',$request->business_id)->first();
        if(empty($business_point)){
          $business_point = \App\Models\Stamp_master::where('business_id',$request->business_id)->first();  
        }
        if($business_point != ''){
            return response(['status'=>'200','Message'=>'Cashback retrieved successfully.','business_point' =>$business_point]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }

        //return view('business.cash_back',compact('user_details','business_point'));
    }
    public function save_cash_back(request $request)
    {
        
        $oldPoint = User::where('id',$request->user_id)->first();
        
        $input['point'] = $oldPoint->point - $request->cash_out_points;
        $input['transaction_type'] = $request->transaction_type;
        $input['business_id'] = $request->business_id;


        $input1['user_id'] = $request->user_id;
        $input1['buss_id'] = $request->business_id;
        $input1['transaction_type_id'] = $request->transaction_type;
        $input1['old_point'] = $oldPoint->point;
        $input1['current_point'] = $oldPoint->point - $request->cash_out_points;
        $input1['cash_out_points'] = $request->cash_out_points;;
        $input1['type'] = '1';

        $transaction_history = \App\Models\Transaction_history::create($input1);

        $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$request->business_id)->first();
        if(empty($bussiness_wise_stamp_point))
        { 
            $total_data['user_id'] = $request->user_id;
            $total_data['business_id'] =$request->business_id;
            $total_data['total_point'] = $bussiness_wise_stamp_point->total_point - $request->cash_out_points;
            $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
        }else{

            $total_data['user_id'] = $request->user_id;
            $total_data['business_id'] =$request->business_id;
            $total_data['total_point'] = $bussiness_wise_stamp_point->total_point - $request->cash_out_points ;
            $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$request->business_id)->update($total_data);

        }

        $update = User::where('id',$request->user_id)->update($input);
        if($update != ''){
            return response(['status'=>'200','Message'=>'Cashback save successfully.']);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
        //Flash::success('Point Updated Sucessfully');
        //return redirect(route('findMember'));
        
    }
    public function sendInvitation(Request $request)
    {
        $user = \App\User::where('email',$request->email)->first();

        if(!empty($user))
        {
            return response(['status'=>'200','Message'=>'User Already Registered.']);
        }
        
        $businessDetails = Brand::where('id',$request->business_id)->first();   
        
        $data['email'] = $request->email;
        $data['business_name'] = $businessDetails->name;
        
        $response = Email_master::send_invitation($data);

        if($businessDetails != ''){
            return response(['status'=>'200','Message'=>'Invitation send successfully.']);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }

        //Flash::success("Invitation Send Sucessfully");
        //return redirect(route('invite_member'));
    }
    public function offerBannersList(Request $request)
    {   
       // $offers = \App\Models\Offer_banner::where('user_id',$request->business_id)->get();
        //$buss_id = User::where('created_by',Auth::user()->created_by)->first();
            $buss_id_data = User::where('userDetailsId',$request->business_id)->where('role_id','3')->first();
          
            $offers = \App\Models\Offer_banner::where('user_id',$buss_id_data->id)->get();
    
        if($offers != ''){
            return response(['status'=>'200','Message'=>'Offer banner retrive successfully.','offers' =>$offers]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }

    }
    public function getFaq(Request $request)
    {   
        $buss_id_data = User::where('userDetailsId',$request->business_id)->where('role_id','3')->first();
          
        $faq = \App\Models\Faqs_business::where('created_by',$buss_id_data->id)->get();
    
        if($faq != ''){
            return response(['status'=>'200','Message'=>'Faq retrive successfully.','faq' =>$faq]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }

    }
    public function transaction_type(Request $request)
    {   
        $data = \App\Models\Gift_vocher_types::orderBy('id','DESC')->get();
    
        if($data != ''){
            return response(['status'=>'200','Message'=>'Transaction Type retrive successfully.','transaction_type' =>$data]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }

    }


    public function appointments_today_view(Request $request)
    {  
        $buss_id = \App\User::where('id',$request->user_id)->first();
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first();

        $book_slot_data = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
        /*echo "<pre>";
        print_r($book_slot);
        exit;*/
        $book_slot = [];
        
        foreach ($book_slot_data as  $data) {

            $appointmentCount = \App\Models\Booking_add_cart_time_order::where('slot_id',$data->id)->whereDate('date', \Carbon\Carbon::today())->count();
            $book_slot[] = array("id" => $data->id,"business_id" => $data->business_id,"slot_time" => $data->slot_time,'limit_per_slot' => $data->limit_per_slot,"slot_price" => $data->slot_price,"created_at" =>$data->created_at,'updated_at' => $data->updated_at,"deleted_at" => $data->deleted_at,"total_booking"=>$appointmentCount);
        }
        

        
        if($book_slot != ''){
            return response(['status'=>'200','Message'=>'appointments retrive successfully.','appointments' =>$book_slot]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
    }
    public function appointments_weekly_view(Request $request)
    {  

        $buss_id = \App\User::where('id',$request->user_id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        

        $carbaoDay = Carbon::now()->startOfWeek();

        $week = []; 
        for ($i=0; $i <7 ; $i++) {
            $week[] = $carbaoDay->startOfWeek()->addDay($i)->format('Y-m-d');//push the current day and plus the mount of $i 
        }

        $book_slot = [];
        foreach ($week as $value) {
            //echo $value."<br>";
            if(!empty($request->member_id))
            {
            $book_slot[] = \App\Models\Slot_timing::where('booking_add_cart_time_order.business_id',$request->user_id)
                                                ->where('booking_add_cart_time_order.user_id',$request->member_id)
                                                ->whereDate('booking_add_cart_time_order.date', $value)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
            }else{
                $book_slot[] = \App\Models\Slot_timing::where('booking_add_cart_time_order.business_id',$request->user_id)
                                                ->whereDate('booking_add_cart_time_order.date', $value)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
            }
        }
        /*s*/



        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        /*$book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->whereBetween('booking_add_cart_time_order.date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();*/
        if($book_slot != ''){
            return response(['status'=>'200','Message'=>'appointments retrive successfully.','appointments' =>$book_slot]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
    }

    public function appointments_monthly_view(Request $request)
    {  
        $buss_id = \App\User::where('id',$request->user_id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        
            $today = Carbon::now(); 
            $dates = []; 

            for($i=1; $i < $today->daysInMonth + 1; ++$i) {
                $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
            }

            $book_slot = [];

            foreach ($dates as $key => $value) {
                if(!empty($request->member_id))
                {
                 $book_slot[] = \App\Models\Slot_timing::where('booking_add_cart_time_order.business_id',$request->user_id)
                                                ->where('booking_add_cart_time_order.user_id',$request->member_id)
                                                ->whereDate('booking_add_cart_time_order.date', $value)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
               }else{
                    $book_slot[] = \App\Models\Slot_timing::where('booking_add_cart_time_order.business_id',$request->user_id)
                                                ->whereDate('booking_add_cart_time_order.date', $value)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
                }
            }
            /*echo "<pre>";
            print_r($book_slot);
            exit;*/

        /*$book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->whereMonth('booking_add_cart_time_order.date', Carbon::now()->month)
                                                //->whereBetween('booking_add_cart_time_order.date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();*/
        if($book_slot != ''){
            return response(['status'=>'200','Message'=>'appointments retrive successfully.','appointments' =>$book_slot]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
    }

    public function save_appointment(Request $request)
    {
        $input = $request->all();

        $user_details = \App\User::where('unique_no',$request->user_id)->first();
        
        
        if(empty($user_details))
        {
            return response(['status'=>'401','Message'=>"User Not Found"]);   
        }
        $last_order =  Booked_services::where('created_by',$request->created_by)->orderBy('id','DESC')->select('booking_id')->first();
        if(!empty($last_order)){
            $input['booking_id'] = $last_order->booking_id + 1;
        }else{

            $input['booking_id'] =  1;
        }
        $input['booking_service_date_time'] = $request->start_date;
        $input['member_id'] = $request->user_id;
        $input['member_name'] = $user_details->name;
        $input['service_name'] = implode(',', $input['product_id']);

        $bookedServices = Booked_services::create($input);
        $booking_id = Booked_services::orderBy('id','DESC')->first();
           for ($i=0; $i<count($request->product_id); $i++) {           
            $input_data['product_id'] = $request->product_id[$i];            
            $input_data['booking_id'] = $booking_id->id;
            
            /*echo "<pre>";
            print_r($input_data);
            exit;*/
            $extra = \App\Models\Booking_addcart_product::create($input_data);
                
        }

        if($bookedServices != ''){

             $cart_extra_get = \App\Models\Cart_extra_details::where('cart_extra_details.user_id', $request->user_id)->whereIn('cart_extra_details.product_id',$request->product_id)->get();

            
            foreach ($cart_extra_get as $value) {
                $requestData= ([
                        'booking_id'    => $booking_id->id,
                        'type'      => '2',
                        'cart_id'      => $value->cart_id,
                        'extra_id'      => $value->extra_id,
                        'product_id'      => $value->product_id,
                        //'product_id'      => $value->product_id,
                        'name'      => $user_details->name,
                        'available_quantities'      => $value->available_quantities,
                        'points_per_quantity'      => $value->points_per_quantity,
                        'price_per_quantity'      => $value->price_per_quantity,
                        'quantity'      => $value->quantity,
                        'user_id'      => $request->user_id,
                       ]);
                //$value['order_id'] = $order_id->id;
                $orde_extra_add = \App\Models\Order_cart_extra_details::create($requestData);
            }
            
            $buss_id = \App\User::where('id',$request->business_user_id)->first();
        
            $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first();          
            //echo 
            ///$Booking_add_cart_time = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->where('time',$request->time)->get();
            /*echo "<pre>";
            print_r($Booking_add_cart_time);
            exit;*/
            //foreach ($Booking_add_cart_time as $value1) {
                    $requestData= ([
                            'booking_id'    => $booking_id->id,
                            'time'      => $request->time,
                            'product_id'      => implode(',', $request->product_id),
                            //'add_cart_id'      => $value1->add_cart_id,
                            'date'      => $request->start_date,
                            'business_id'      => $business_id->id,
                            'slot_id' => $request->slot_id,
                            'user_id' => $request->user_id,
                            ]);
                    $orde_extra_add = \App\Models\Booking_add_cart_time_order::create($requestData);
            //}

            for ($i=0; $i<count($request->product_id); $i++) {
            $product_time = \App\Models\Booking_add_cart_time_order::where('booking_id',$booking_id->id)
                                        ->select('time')->first(); 
            $product_name_extra = \App\Models\Extra_services::where('product_id',$request->product_id)
                                        ->select('services_name')->first();     
            $input_data_details['product_id'] = $request->product_id[$i];
            $input_data_details['product_name_extra'] = @$product_name_extra->services_name;
            $input_data_details['booking_id'] = $booking_id->id;
            $input_data_details['type'] = 2;
            $input_data_details['booking_date'] = $request->start_date;
            $input_data_details['product_time_array'] = @$product_time->time;
            $extra = \App\Models\Booked_services_details::create($input_data_details);
                
            }


            $data = Date('Y-m-d : h:s:i');
            $cart = \App\Models\Add_cart::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
            $cart_extra = \App\Models\Cart_extra_details::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
             $Booking_addcart_product = \App\Models\Booking_addcart_product::whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
            //return response(['status'=>'200','Message'=>'Booking added successfully.','bookedServices' => $bookedServices]);

        }
        if($Booking_addcart_product != ''){
            return response(['status'=>'200','Message'=>'appointments created successfully.']);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
        /*Flash::success('Appointment Created successfully');
        return redirect(url('appointments_view'));*/
        //return view('business.findMember');
        //return $this->sendResponse(new Booked_servicesResource($bookedServices), 'Booked Services saved successfully');
    }
    public function update_book_appointment(request $request)
    {
        /*echo "<pre>";
        print_r($request->all());
        exit;*/
        $input = $request->all();

        $update_data['status']  =$input['status'];
        $update = \App\Models\Booked_services::where('id',$request->booking_id)->update($update_data);

        $bookedServices = \App\Models\Booked_services::where('id',$request->booking_id)->first();
        $order_data = \App\Models\Booked_services::where('id',$request->id)->first();
        $buss_name = \App\User::where('id',$bookedServices->created_by)->first();

        if($request->status == 'Open')
        {
            $message = "Thank you! Your appointment dated ".@$order_data['booking_service_date_time']." is being received by ".@$buss_name['name']."";
        }
        else if($request->status == 'Confirm' )
        {
            $message = "Congratulation! Your appointment at ".@$buss_name['name']." is being confirmed dated ".@$order_data['booking_service_date_time']."";
        }
        else if($request->status == 'Reschedule' )
        {
            $message = "Sorry for the inconvenience! Your appointment dated ".@$order_data['booking_service_date_time']."  ".@$buss_name['name']." is being canceled and rescheduled at ".@$order_data['booking_service_date_time']."";
        }
      
        else if($request->status == 'Cancel' )
        {
            $message = "Sorry for the inconvenience! Your appointment dated ".@$order_data['booking_service_date_time']." at ".@$buss_name['name']." is being canceled.";
        }

        $firebaseToken = \App\User::where('users.role_id',4)->where('users.id',$bookedServices->member_id)->whereNotNull('device_token')->pluck('device_token')->all();
        
        //where('id',14)

        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Appointment",
                "message" => "Appointment status has been changed by business..",
                "body" => $message,
                "member_id" =>$bookedServices->member_id,

            ], 
            "data" => [
                "buss_id" =>$bookedServices->member_id,
                "message" => $message,
                "type" => "Appointment",
            ]         

        ];
      
        $dataString = json_encode($data);  

        /*echo "<pre>";
        print_r($dataString); exit;*/
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',

        ];
        $ch = curl_init();    

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        $data = json_decode($response);
        if($update)
        {
            /*Flash::success('Appointment Updated successfully');
            return redirect(url('appointments_view'));*/
            return response(['status'=>'200','Message'=>'Appointment Updated successfully.']);
        }
        else
        {
            return response(['status'=>'401','Message'=>'Appointment not updated successfully.']);
        }
    }

    public function servies_list(Request $request)
    {
        $buss_id = \App\User::where('id',$request->business_user_id)->first();

        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
      /*  echo "<pre>";
        print_r($business_id->id); exit;*/

        $services = \App\Models\Services_product::where('created_by',$request->business_user_id)->get();

        if($services != ''){
            return response(['status'=>'200','Message'=>'services retrive successfully.','services' =>$services]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
    }
    public function get_slot_by_date(Request $request)
    {
        $buss_id = \App\User::where('id',$request->business_user_id)->first();
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first();

        if(!empty($request->member_id))
        {
            $book_slot_data = \App\Models\Slot_timing::whereDate('booking_add_cart_time_order.date', $request->date)
                                                ->where('booking_add_cart_time_order.business_id',$request->business_user_id)
                                                ->where('booking_add_cart_time_order.user_id',$request->member_id)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
        }else{
            $book_slot_data = \App\Models\Slot_timing::whereDate('booking_add_cart_time_order.date', $request->date)
                                                ->where('booking_add_cart_time_order.business_id',$request->business_user_id)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();
        }
        $book_slot = [];
        
        foreach ($book_slot_data as  $data) {

            $appointmentCount = \App\Models\Booking_add_cart_time_order::where('slot_id',$data->id)->whereDate('date', $request->date)->count();
            $book_slot[] = array("id" => $data->id,"business_id" => $data->business_id,"slot_time" => $data->slot_time,'limit_per_slot' => $data->limit_per_slot,"slot_price" => $data->slot_price,"created_at" =>$data->created_at,'updated_at' => $data->updated_at,"deleted_at" => $data->deleted_at,"total_booking"=>$appointmentCount);
        }
        
        if($book_slot != ''){
            return response(['status'=>'200','Message'=>'appointments retrive successfully.','appointments' =>$book_slot]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
    }
    public function get_booked_appointment(Request $request)
    {
        $buss_id = \App\User::where('id',$request->business_user_id)->first();
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first();
        if(isset($request->date) && $request->date != '')
        {
            $booking_data = \App\Models\Booking_add_cart_time_order::where('slot_id',$request->slot_id)
                                                            ->where('booking_add_cart_time_order.business_id',$request->business_user_id)
                                                            ->whereDate('booking_add_cart_time_order.date', $request->date)
                                                            ->leftJoin('booked_services','booking_add_cart_time_order.booking_id','booked_services.id')                                                            
                                                            ->leftJoin('services_product','booked_services.service_name','services_product.id')
                                                            ->leftJoin('users','booked_services.member_id','users.id')
                                                            ->select('booking_add_cart_time_order.*','booked_services.id as bookingId','booked_services.status as bookingStatus','booked_services.comments','users.id as userId','users.name','users.email as userEmail','users.mobile_no as mobile','users.unique_no as uniqueNo','services_product.name as serviceName')
                                                            ->get();
        }
        else
        {
            $booking_data = \App\Models\Booking_add_cart_time_order::where('slot_id',$request->slot_id)
                                                            ->where('booking_add_cart_time_order.business_id',$request->business_user_id)
                                                            ->whereDate('booking_add_cart_time_order.date', \Carbon\Carbon::today())
                                                            ->leftJoin('booked_services','booking_add_cart_time_order.booking_id','booked_services.id')
                                                            ->leftJoin('services_product','booked_services.service_name','services_product.id')
                                                            ->leftJoin('users','booked_services.member_id','users.id')
                                                            ->select('booking_add_cart_time_order.*','booked_services.id as bookingId','booked_services.status as bookingStatus','booked_services.comments','users.id as userId','users.name','users.email as userEmail','users.mobile_no as mobile','users.unique_no as uniqueNo','services_product.name as serviceName')
                                                            ->get();
        }
        
        if($booking_data != ''){
            return response(['status'=>'200','Message'=>'appointments retrive successfully.','appointments' =>$booking_data]);
        }else{
            return response(['status'=>'401','Message'=>"Something went wrong"]);
        }
    }
}