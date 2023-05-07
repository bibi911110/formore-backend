<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVoucherAPIRequest;
use App\Http\Requests\API\UpdateVoucherAPIRequest;
use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\VoucherResource;
use Response;
use Auth;

/**
 * Class VoucherController
 * @package App\Http\Controllers\API
 */

class VoucherAPIController extends AppBaseController
{
    /** @var  VoucherRepository */
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->voucherRepository = $voucherRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/vouchers",
     *      summary="Get a listing of the Vouchers.",
     *      tags={"Voucher"},
     *      description="Get all Vouchers",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Voucher")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $vouchers = $this->voucherRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        return $this->sendResponse(VoucherResource::collection($vouchers), 'Vouchers retrieved successfully');
    }
    public function get_vouchers(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); exit;
        if(!empty($request['type']) && $request['type'] = 'lottery')
        {
            $today = date('Y-m-d');
            $vouchers = \App\Models\User_voucher::leftjoin('voucher','user_wallet.voucher_id','voucher.id')
            //->where('user_wallet.user_id',$request->user_id)
            ->where('user_wallet.used_code_status','0')
            ->where('user_wallet.user_id', $request->user_id)
            //->where('user_wallet.user_id',$request->user_id)
            //where('user_wallet.used_code_status','0')
            ->where('voucher.code_status','1')
            ->whereDate('campaign_start_date','<=', $today)
            ->whereDate('campaign_end_date','>=', $today)
            ->where('voucher.campaign_type','4')
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();
        }
        else
        {
          /*Changes on 16-06-2022 */
             $today = date('Y-m-d');
          //  echo "string"; exit;
             $vouchers = \App\Models\User_voucher::leftjoin('voucher','user_wallet.voucher_id','voucher.id')
            //->where('user_wallet.user_id',$request->user_id)
            ->where('user_wallet.used_code_status','0')
            ->where('user_wallet.user_id', $request->user_id)
            ->where('voucher.code_status','1')
            //Old ->where('voucher.code_status','1')
            ->where('voucher.campaign_type','!=','4')
            ->whereDate('start_date','<=', $today)
            ->whereDate('end_date','>=', $today)
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName','user_wallet.used_code_status as status_wallet')
            ->orderBy('voucher.id','DESC')->get();
        }

        
        if($vouchers != ''){
            return response(['status'=>'200','Message'=>'Vouchers retrieved successfully.','vouchers' => $vouchers]);
        }else{
            return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
        }
    }
    public function brand_vocher_wise(Request $request)
   {

            if(!empty($request['type']) && $request['type'] = 'lottery')
            {
                 $today = date('Y-m-d');
                 $brand = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
                            ->select('brand.id as brand_id','brand.name as bussName','brand.brand_icon as bussLogo')
                           // ->where('voucher.campaign_type','4')
                            ->whereDate('campaign_start_date','<=', $today)
                            ->whereDate('campaign_end_date','>=', $today)
                            //->where('voucher.code_status','1')
                            ->where('voucher.category_id','4')
                            ->where('voucher.code_status','0')
                            ->groupBy('voucher.business_id')
                            ->get();
            }
            else if(empty($request['type']) && $request['type'] != 'lottery')
            {
                $today = date('Y-m-d');
                 $brand = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
                            ->select('brand.id as brand_id','brand.name as bussName','brand.brand_icon as bussLogo')
                            ->where('voucher.category_id','3')
                            ->whereDate('start_date','<=', $today)
                           ->whereDate('end_date','>=', $today)
                          // ->where('voucher.code_status','1')
                            ->where('voucher.code_status','0')
                            ->groupBy('voucher.business_id')
                            ->get();

            }
        
        if($brand != ''){
            return response(['status'=>'200','Message'=>'Brand retrieved successfully.','brand' => $brand]);
        }else{
            return response(['status'=>'401','Message'=>"Brand Not Found"]);
        }   
    }
       
   

    public function get_vouchers_campaign(Request $request)
    {
     
       if(!empty($request['type']) && $request['type'] = 'lottery')
      {
       $vouchers = \App\Models\Voucher::
            //->where('user_wallet.user_id',$request->user_id)
            //->where('user_wallet.used_code_status','1')
           // ->where('voucher.code_status','1')
            where('voucher.category_id','3')
            ->where('voucher.campaign_type','4')
            ->where('voucher.business_id',$request->business_id)
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();
        } 
        else
            {
            $today = date('Y-m-d');
            $vouchers = \App\Models\Voucher::
            //->where('user_wallet.user_id',$request->user_id)
            //->where('user_wallet.used_code_status','1')
           // ->where('voucher.code_status','1')
            where('voucher.category_id','3')
            ->where('voucher.code_status','0')
            ->where('voucher.business_id',$request->business_id)
            ->whereDate('campaign_start_date','<=', $today)
            ->whereDate('campaign_end_date','>=', $today)
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();
        }
        
        if($vouchers != ''){
            return response(['status'=>'200','Message'=>'Vouchers campaign retrieved successfully.','vouchers' => $vouchers]);
        }else{
            return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
        }   
    }
    public function get_lottery(Request $request)
    {
        $lottery = \App\Models\Lotery_code_details::where('lotery_code_details.voucher_id',$request->voucher_id)
                                                    ->where('status','0')
                                                  ->get();
        
         $voucher_lottery_participants = \App\Models\Voucher::where('id',$request->voucher_id)
                                            ->select('lottery_participants','end_date')
                                            ->first();
        if($lottery != ''){
            return response(['status'=>'200','Message'=>'Lottery retrieved successfully.','lottery_participants'=>$voucher_lottery_participants,'Lottery' => $lottery]);
        }else{
            return response(['status'=>'401','Message'=>"lottery Not Found"]);
        }
    }

    public function lottery_code_scan(Request $request)
    {

       $voucher_id =  \App\Models\Lotery_code_details::where('lotery_code',$request->lotery_code)->first();
       $voucher_data =  \App\Models\Voucher::where('id',$voucher_id->voucher_id)->first();  
      // $todayDate = date('Y-m-d');
       if($voucher_data->start_date <= $voucher_data->end_date)
       {
               if($voucher_id->status == 0)
               {
                   $lottery_participants = $voucher_data->lottery_participants + 1;
                   $lottery = \App\Models\Lotery_code_details::where('lotery_code',$request->lotery_code)->update(['status' => 1]);

                   $voucher_lottery_participants = \App\Models\Voucher::where('id',$voucher_id->voucher_id)->update(['lottery_participants' => $lottery_participants]);
                    
                    if($lottery != ''){
                        return response(['status'=>'200','Message'=>'Lottery Scan successfully.']);
                    }else{
                        return response(['status'=>'401','Message'=>"lottery Not Found"]);
                    }
                }
                else
                {
                    return response(['status'=>'401','Message'=>"lottery Code Used"]);
                }
        }else{
            return response(['status'=>'401','Message'=>"lottery Code expired"]);
        }
    }

    
    public function get_used_vouchers(Request $request)
    {
        $today = date('Y-m-d');

        $used = \App\Models\User_voucher::leftjoin('voucher','user_wallet.voucher_id','voucher.id')
        ->where('user_wallet.user_id',$request->user_id)
        ->where('user_wallet.used_code_status','1')
        ->where('voucher.code_status','1')
        ->whereNotNull('user_wallet.assigned_user_id')
        //->where('voucher.code_status','0')
       // ->whereDate('voucher.end_date','<=',$todayDate)
        ->whereDate('start_date','<=', $today)
        ->whereDate('end_date','>=', $today)
        ->leftjoin('brand','voucher.business_id','brand.id')
        ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
        ->leftjoin('country','voucher.country_id','country.id')
        ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
        ->orderBy('voucher.id','DESC')->get();

       $today = date('Y-m-d');
       $active = \App\Models\User_voucher::leftjoin('voucher','user_wallet.voucher_id','voucher.id')
        ->where('user_wallet.user_id',$request->user_id)
        ->where('user_wallet.used_code_status','0')
       // ->where('voucher.code_status','0')
        ->where('voucher.code_status','1')
        ->whereDate('start_date','<=', $today)
        ->whereDate('end_date','>=', $today)
        ->leftjoin('brand','voucher.business_id','brand.id')
        ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
        ->leftjoin('country','voucher.country_id','country.id')
        ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
        ->orderBy('voucher.id','DESC')->get();
            

       /* $expired = \App\Models\User_voucher::leftjoin('voucher','user_wallet.voucher_id','voucher.id')
            ->where('user_wallet.user_id',$request->user_id)
            ->where('voucher.code_status','1')
            //->whereDate('voucher.start_date','>=',$todayDate)
            ->whereDate('voucher.end_date','<=',$todayDate)
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();*/
        
            if($used != '' || $active != ''){
                return response(['status'=>'200','Message'=>'Vouchers retrieved successfully.','used' => $used, "active" => $active]);
            }else{
                return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
            }
    }

    /* Date of expiration */
    public function date_of_expiration_voucher(Request $request)
    {
        $todayDate = date('Y-m-d');
        
        $date_of_expiration_voucher = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
            ->where('voucher.code_status','0')
            ->whereDate('voucher.start_date','<=',$todayDate)
            ->whereDate('voucher.end_date','>=',$todayDate)
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();        

            if($date_of_expiration_voucher != ''){
                return response(['status'=>'200','Message'=>'Vouchers retrieved successfully.',"date_of_expiration_voucher" => $date_of_expiration_voucher]);
            }else{
                return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
            }
    }
    /*Voucher category*/ 
    public function get_voucher_category(Request $request)
    {   
        $voucher_category = \App\Models\Voucher_category::where('status','1')->get();


            if($voucher_category != ''){
                return response(['status'=>'200','Message'=>'Vouchers retrieved successfully.',"voucher_category" => $voucher_category]);
            }else{
                return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
            }
    }
    /*Voucher by business id*/
    public function get_voucher_for_business(Request $request)
    {   
        $voucher_for_business = \App\Models\Voucher::leftjoin('brand','voucher.business_id','brand.id')
            ->where('voucher.code_status','0')
            ->where('voucher.business_id',$request->business_id)
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();        
        if($voucher_for_business != ''){
            return response(['status'=>'200','Message'=>'Vouchers retrieved successfully.',"voucher_for_business" => $voucher_for_business]);
        }else{
            return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
        }
    }
    public function super_deal_vocher(Request $request)
    {
        //$vouchers = [];
      if(!empty($request['levels_based_on_scenarios']) && isset($request['levels_based_on_scenarios']))
      {
        $vouchers = \App\Models\Voucher::
            //->where('user_wallet.user_id',$request->user_id)
            //->where('user_wallet.used_code_status','1')
            where('voucher.category_id','2')
           ->where('voucher.code_status','0')
            ->where('voucher.business_id',$request->business_id)
            ->where('voucher.levels_based_on_scenarios',$request->levels_based_on_scenarios)
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();
      }
      else
      {
        $vouchers = \App\Models\Voucher::
            //->where('user_wallet.user_id',$request->user_id)
            //->where('user_wallet.used_code_status','1')
            where('voucher.category_id','2')
           ->where('voucher.code_status','0')
            ->where('voucher.business_id',$request->business_id)
            ->leftjoin('brand','voucher.business_id','brand.id')
            ->leftjoin('voucher_category','voucher.category_id','voucher_category.id')
            ->leftjoin('country','voucher.country_id','country.id')
            ->select('voucher.*','brand.name as bussName','brand.brand_icon as bussLogo','voucher_category.voucher_category as voucherCategory','country.country_name as countryName')
            ->orderBy('voucher.id','DESC')->get();
      }
         

        if($vouchers != ''){
            return response(['status'=>'200','Message'=>'Vouchers super deal retrieved successfully.','vouchers' => $vouchers]);
        }else{
            return response(['status'=>'401','Message'=>"Vouchers Not Found"]);
        } 
    }

    public function nfc_scan(Request $request)
    {
        $current_date = \Carbon\Carbon::now();
        
        

        $Nfc_code = \App\Models\Nfc_code::where('nfc_code',$request->nfc_code)->first();
        $transaction_check_count = \App\Models\Transaction_history::where('user_id',$request->user_id)
                            ->where('nfc_code',$request->nfc_code)
                            ->whereDate('created_at', $current_date)
                            ->count();
        $getLimit = \App\Models\Stamp_master::where('id',$Nfc_code->stamp_id)->first();

        //echo $getLimit->daily_limit;
        //echo $transaction_check_count;
        //exit;
        if($getLimit->daily_limit <= $transaction_check_count)   
        {
            return response(['status'=>'401','Message'=>"Your Daily Limit is over"]);
        }           
        if(!empty($Nfc_code))
        {


        $buss_id = \App\Models\Stamp_master::where('id',$Nfc_code->stamp_id)->first();
        $user_id = \App\User::where('role_id','3')
                            ->where('userDetailsId',$buss_id['business_id'])
                            ->first();
        /*echo "<pre>";
        print_r($buss_id); exit;*/
        $check = \App\Models\My_rewards::where('user_id',$request->user_id)->first();
           
                    $credit['user_id'] = $request->user_id;
                    $credit['nfc_code'] = $request->nfc_code;
                    $credit['buss_id'] = $buss_id['business_id'];
                    $credit['stamps'] = 1;
                    $credit['setup_level'] = $buss_id['setup_level'];
                    $credit['point_per_stamp'] = $buss_id['point_per_stamp'];
                    $credit['setup_level_count'] =  1;
                    $rewards = \App\Models\My_rewards::create($credit);

                 $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id['business_id'])->where('user_id',$request->user_id)->first();

                if(empty($bussiness_wise_stamp_point))
                { 
                    $total_data['user_id'] = $request->user_id;
                    $total_data['business_id'] = $buss_id['business_id'];
                    $total_data['total_stamp'] = 1;
                    $total_data['total_point'] = $buss_id['point_per_stamp'] + @$oldPoint->point;
                    $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
                }else{
                    //echo "Dd"; exit;

                    $total_data['user_id'] = $request->user_id;
                    $total_data['business_id'] = $buss_id['business_id'];
                    $total_data['total_stamp'] = $bussiness_wise_stamp_point->total_stamp + 1;
                    $total_data['total_point'] = $buss_id['point_per_stamp'] + @$oldPoint->point ;
                    $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id['business_id'])->where('user_id',$request->user_id)->update($total_data);

                }

            }
            elseif(!empty($check) && isset($buss_id['business_id']) && $buss_id['setup_level'] <= $check['setup_level_count'])
            {
                    $credit['user_id'] = $request->user_id;
                    $credit['nfc_code'] = $request->nfc_code;
                    $credit['buss_id'] = $buss_id['business_id'];
                    $credit['stamps'] = 1;
                    $credit['setup_level'] =  $buss_id['setup_level'];
                    $credit['point_per_stamp'] = 0;
                     $credit['setup_level_count'] = 0;
                    $rewards = \App\Models\My_rewards::where('user_id',$request->user_id)->update($credit);

                $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id['business_id'])->where('user_id',$request->user_id)->first();

                if(empty($bussiness_wise_stamp_point))
                { 
                    $total_data['user_id'] = $request->user_id;
                    $total_data['business_id'] = $buss_id['business_id'];
                    $total_data['total_stamp'] = 1;
                    $total_data['total_point'] = $buss_id['point_per_stamp'];
                    $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
                }else{

                    $total_data['user_id'] = $request->user_id;
                    $total_data['business_id'] = $buss_id['business_id'];
                    $total_data['total_stamp'] = $bussiness_wise_stamp_point->total_stamp + 1;
                    $total_data['total_point'] = $buss_id['point_per_stamp'] + $bussiness_wise_stamp_point->total_point ;
                    $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id['business_id'])->where('user_id',$request->user_id)->update($total_data);

                }
            }
            elseif(!empty($check) && isset($buss_id['business_id']) && $buss_id['setup_level'] >= $check['setup_level_count'])
            {
                    $credit['user_id'] = $request->user_id;
                    $credit['nfc_code'] = $request->nfc_code;
                    $credit['buss_id'] = $buss_id['business_id'];
                    $credit['stamps'] = $check['stamps'] + 1;
                    $credit['setup_level'] =  $buss_id['setup_level'];
                    $credit['point_per_stamp'] = $check['point_per_stamp'] + $buss_id['point_per_stamp'];
                    $credit['setup_level_count'] = $check['setup_level_count'] + 1;
                    $rewards = \App\Models\My_rewards::where('user_id',$request->user_id)->update($credit);

                $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id['business_id'])->where('user_id',$request->user_id)->first();

                if(empty($bussiness_wise_stamp_point))
                { 
                    $total_data['user_id'] = $request->user_id;
                    $total_data['business_id'] = $buss_id['business_id'];
                    $total_data['total_stamp'] = 1;
                    $total_data['total_point'] = $buss_id['point_per_stamp'];
                    $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
                }else{

                    $total_data['user_id'] = $request->user_id;
                    $total_data['business_id'] = $buss_id['business_id'];
                    $total_data['total_stamp'] = $bussiness_wise_stamp_point->total_stamp + 1;
                    $total_data['total_point'] = $buss_id['point_per_stamp'] +  $bussiness_wise_stamp_point->total_point ;
                    $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id['business_id'])->where('user_id',$request->user_id)->update($total_data);

                }
            }
            else{
                return response(['status'=>'401','Message'=>"Your code wrong"]);
            }
         $rewards_data = \App\Models\My_rewards::leftjoin('users','my_rewards.buss_id','users.id')
                                ->leftjoin('stamp_master','users.userDetailsId','stamp_master.business_id')
                                ->where('my_rewards.user_id',$request->user_id)
                                 ->select('my_rewards.*','my_rewards.stamps as ustamp','stamp_master.business_id','stamp_master.color','stamp_master.image_of_loyalty_card','stamp_master.font_size')
                                ->first();
        


         /*transaction_history*/
            $rewards1['user_id'] = $rewards->user_id;
            $rewards1['nfc_code'] = $rewards['nfc_code'];
            $rewards1['buss_id'] = $rewards['buss_id'];
            $rewards1['stamps'] = $rewards['stamps'];
            $rewards1['setup_level'] = $rewards['setup_level'];
            $rewards1['point_per_stamp'] = $rewards['point_per_stamp'];
            $rewards1['transaction_type_id'] = $buss_id['transaction_type'];
            $rewards1['type'] = 2;
            $transaction_history = \App\Models\Transaction_history::create($rewards1);
        /*Update rewards*/
        if($rewards != ''){
                return response(['status'=>'200','Message'=>'Rewards added successfully.','rewards' => $rewards_data]);
        }else{
            return response(['status'=>'401','Message'=>"Rewards Not Found"]);
        }
    }
     /*my_rewards*/
     public function my_rewards(Request $request)
    {   
        //$my_rewards_point = [];
        $my_rewards1 = \App\User::leftjoin('bussiness_wise_stamp_point','users.userDetailsId','bussiness_wise_stamp_point.business_id')
                                ->leftjoin('my_rewards','bussiness_wise_stamp_point.user_id','my_rewards.user_id')
                                ->leftjoin('stamp_master','bussiness_wise_stamp_point.business_id','stamp_master.business_id')
                                ->leftjoin('brand','my_rewards.buss_id','brand.id')
                                //->leftjoin('bussiness_wise_stamp_point','my_rewards.buss_id','bussiness_wise_stamp_point.business_id')
                                ->where('my_rewards.user_id',$request->user_id)
                                ->where('brand.stamp_point','1')
                                /*->OrWhere('users.stamp','!=',0)
                                ->OrWhere('users.point','!=',0)*/
                                ->select('my_rewards.*','my_rewards.stamps as mstamps','users.stamp as ustamp','users.point','brand.name as brandName','brand.brand_icon','stamp_master.business_id','stamp_master.color','stamp_master.image_of_loyalty_card','stamp_master.font_size','bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point')
                                ->orderBy('my_rewards.id','DESC')
                                //->groupBy('my_rewards.id')
                                //->groupBy('my_rewards.buss_id')
                                ->groupBy('my_rewards.user_id')
                                //->whereNotNull('my_rewards.deleted_at')
                                ->get();  

        $my_rewards = [];
        foreach ($my_rewards1 as $value) {
        $user_d = \App\User::where('id',$value->buss_id)->first();
        $ustamp = \App\Models\Bussiness_wise_stamp_point::where('user_id',$request->user_id)
                                                       ->where('business_id',@$user_d->userDetailsId)
                                                        ->first();
        $brandName = \App\Models\Brand::where('id',@$user_d->userDetailsId)->first();
       /* echo"<pre>";
        print_r($brandName); exit;*/
        $my_rewards[] = array('id' => $value->id,
                                 'user_id' => $value->user_id,
                                 'nfc_code' => $value->nfc_code,
                                 'buss_id' => $value->buss_id,
                                 'stamps' => $value->stamps,
                                 'setup_level' => $value->setup_level,
                                 'point_per_stamp' => $value->point_per_stamp,
                                 'setup_level_count' => $value->setup_level_count,
                                 'created_at' => $value->created_at,
                                 'updated_at' => $value->updated_at,
                                 'deleted_at' => $value->deleted_at,
                                 //'ustamp' => $value->total_stamp,
                                 'ustamp' => @$ustamp->total_stamp,
                                 //'point' => $value->total_point,
                                 //'point' => $value->point_per_stamp * $value->mstamps,
                                 'point' => @$ustamp->total_point,
                                 'brandName' => @$brandName->name,
                                 'brand_icon' => @$brandName->brand_icon,
                                 'business_id' => @$brandName->business_id,
                                 'color' => $value->color,
                                 'image_of_loyalty_card' => $value->image_of_loyalty_card,
                                 'font_size' => $value->font_size,
                                 'total_stamp' => $value->total_stamp,
                                 'total_point' => $value->total_point,
                                );
        }



      /*
        if(count($my_rewards) == 0)
        {*/
            

          $my_rewards_point = \App\User::leftjoin('brand','users.business_id','brand.id')
                                  ->leftjoin('bussiness_wise_stamp_point','brand.id','bussiness_wise_stamp_point.business_id')
                                  //->leftjoin('stamp_master','users.business_id','stamp_master.business_id')
                                  ->leftjoin('points_master','brand.id','points_master.business_id')
                                  ->where('bussiness_wise_stamp_point.user_id',$request->user_id)
                                  ->where('brand.stamp_point','2')
                                  ->select('points_master.*','bussiness_wise_stamp_point.total_point as point','brand.name as brandName','brand.id as  brans_id','brand.brand_icon')
                                 // ->orderBy('my_rewards.id','DESC')
                                  /*->where('stamp_master.deleted_at', NULL)
                                  ->where('brand.deleted_at', NULL)
                                  ->where('points_master.deleted_at', NULL)*/
                                  ->groupBy('bussiness_wise_stamp_point.id')
                                  ->groupBy('brand.id')
                                  ->get();
      /*  }*/
        /*echo "<pre>";
        print_r($my_rewards_point); exit;*/
        /*else
        {
            $my_rewards_point = [];
        }*/
        if($my_rewards != '' || $my_rewards_point != ''){
            return response(['status'=>'200','Message'=>'My rewards retrieved successfully.',"my_rewards" => $my_rewards,'my_rewards_point' =>$my_rewards_point]);
        }else{
            return response(['status'=>'401','Message'=>"My rewards Not Found"]);
        }
    }


    /*transaction_history*/
    public function transaction_history(Request $request)
    {   

        if(!empty($request->buss_id) && !empty($request->user_id))
        {
            $transaction_history = \App\User::leftjoin('transaction_history','users.id','transaction_history.user_id')
                                ->leftjoin('brand','transaction_history.buss_id','brand.id')
                                ->leftjoin('gift_vocher_types','transaction_history.transaction_type_id','gift_vocher_types.id')
                               // ->leftjoin('stamp_master','transaction_history.buss_id','stamp_master.business_id')
                                ->where('transaction_history.user_id',$request->user_id)
                                ->where('transaction_history.buss_id',$request->buss_id)
                                ->select('transaction_history.*','users.point','brand.name as brandName','brand.brand_icon','gift_vocher_types.name')
                                ->orderBy('transaction_history.id','DESC')
                                ->groupBy('transaction_history.id')
                                ->get();  
        }
        else
        {
            $transaction_history = \App\User::leftjoin('transaction_history','users.id','transaction_history.user_id')
                                ->leftjoin('brand','transaction_history.buss_id','brand.id')
                                ->leftjoin('gift_vocher_types','transaction_history.transaction_type_id','gift_vocher_types.id')
                               // ->leftjoin('stamp_master','transaction_history.buss_id','stamp_master.business_id')
                                 ->where('transaction_history.user_id',$request->user_id)
                                ->select('transaction_history.*','users.point','brand.name as brandName','brand.brand_icon','gift_vocher_types.name')
                                ->orderBy('transaction_history.id','DESC')
                                /*->where('stamp_master.deleted_at', NULL)
                                ->where('brand.deleted_at', NULL)
                                ->where('points_master.deleted_at', NULL)*/
                                ->groupBy('transaction_history.id')
                                ->get();     
        }
                     
        if($transaction_history != ''){
            return response(['status'=>'200','Message'=>'Transaction history retrieved successfully.',"transaction_history" => $transaction_history]);
        }else{
            return response(['status'=>'401','Message'=>"Transaction history Not Found"]);
        }
    }

    
    /**
     * @param CreateVoucherAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/vouchers",
     *      summary="Store a newly created Voucher in storage",
     *      tags={"Voucher"},
     *      description="Store Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVoucherAPIRequest $request)
    {
        $input = $request->all();

        $voucher = $this->voucherRepository->create($input);

        return $this->sendResponse(new VoucherResource($voucher), 'Voucher saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/vouchers/{id}",
     *      summary="Display the specified Voucher",
     *      tags={"Voucher"},
     *      description="Get Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            return $this->sendError('Voucher not found');
        }

        return $this->sendResponse(new VoucherResource($voucher), 'Voucher retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVoucherAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/vouchers/{id}",
     *      summary="Update the specified Voucher in storage",
     *      tags={"Voucher"},
     *      description="Update Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVoucherAPIRequest $request)
    {
        $input = $request->all();

        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            return $this->sendError('Voucher not found');
        }

        $voucher = $this->voucherRepository->update($input, $id);

        return $this->sendResponse(new VoucherResource($voucher), 'Voucher updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/vouchers/{id}",
     *      summary="Remove the specified Voucher from storage",
     *      tags={"Voucher"},
     *      description="Delete Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            return $this->sendError('Voucher not found');
        }

        $voucher->delete();

        return $this->sendSuccess('Voucher deleted successfully');
    }
}
