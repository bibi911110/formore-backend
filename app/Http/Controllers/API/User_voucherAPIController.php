<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUser_voucherAPIRequest;
use App\Http\Requests\API\UpdateUser_voucherAPIRequest;
use App\Models\User_voucher;
use App\Repositories\User_voucherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\User_voucherResource;
use Response;
use Auth;

/**
 * Class User_voucherController
 * @package App\Http\Controllers\API
 */

class User_voucherAPIController extends AppBaseController
{
    /** @var  User_voucherRepository */
    private $userVoucherRepository;

    public function __construct(User_voucherRepository $userVoucherRepo)
    {
        $this->userVoucherRepository = $userVoucherRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/userVouchers",
     *      summary="Get a listing of the User_vouchers.",
     *      tags={"User_voucher"},
     *      description="Get all User_vouchers",
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
     *                  @SWG\Items(ref="#/definitions/User_voucher")
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
        $userVouchers = $this->userVoucherRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(User_voucherResource::collection($userVouchers), 'User Vouchers retrieved successfully');
    }

    /**
     * @param CreateUser_voucherAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/userVouchers",
     *      summary="Store a newly created User_voucher in storage",
     *      tags={"User_voucher"},
     *      description="Store User_voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User_voucher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User_voucher")
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
     *                  ref="#/definitions/User_voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $voucher_details = \App\Models\Voucher::where('code',$input['code'])->first();
       /*  echo "<pre>";
         print_r($voucher_details); exit;
*/
        if(!empty($voucher_details) && $voucher_details->code != '')
        {
            $todayDate = date('Y-m-d');
            if($voucher_details->category_id == '3')
            {
                if(!empty($voucher_details) && $voucher_details->code === $input['code'])
                {
                    if($todayDate >= $voucher_details->start_date )
                    {
                        if($todayDate <= $voucher_details->end_date )
                        {
                            if($voucher_details->code_status == '0' )
                            {   
                                if($todayDate >= $voucher_details->campaign_start_date)
                                {
                                    if($todayDate <= $voucher_details->campaign_end_date )
                                    {

                                        $business_details = \App\Models\Brand::where('id',$voucher_details->business_id)->first();
                                        $businessPoints = \App\Models\Points_master::where('business_id',$business_details->id)->first();
                                        if(!empty($businessPoints))
                                        {
                                            $input['points'] = $businessPoints->welcome_point;
                                        }
                                        else
                                        {
                                            $input['stamps'] = '1';
                                        }
                                        $input['used_code_status'] = 0;
                                        $input['voucher_id'] = $voucher_details->id;
                                        $userVoucher = $this->userVoucherRepository->create($input);                
                                        //$data['voucher_id'] = $voucher_details->id;
                                        $data['code_status'] = 1;
                                        $voucherUpdate = \App\Models\Voucher::where('id',$voucher_details->id)->update($data);
                                        /*Language wise msg set*/
                                        if(!empty($request->language_id) && $request->language_id == '1')
                                        {
                                            $voucher_msg = $voucher_details->text_for_win_code_eng;
                                        }
                                        else if(!empty($request->language_id) &&$request->language_id == '2')
                                        {
                                            $voucher_msg = $voucher_details->text_for_win_code_albanian;
                                        }
                                        else if(!empty($request->language_id) && $request->language_id == '3')
                                        {
                                            $voucher_msg = $voucher_details->text_for_win_code_greek;
                                        }
                                        else if(!empty($request->language_id) && $request->language_id == '4')
                                        {
                                            $voucher_msg = $voucher_details->text_for_win_code_italian;
                                        }
                                        else
                                        {
                                            $voucher_msg = "Pass language id";
                                        }

                                        return response(['status'=>'200','Message'=> $voucher_msg]);

                                        //return $this->sendResponse(new User_voucherResource($userVoucher), 'you win a voucher of '.$voucher_details->code.' and create the voucher (wallet)');
                                    }
                                    else
                                    {
                                        return response(['status'=>'401','Message'=>"Campaign is ended"]);
                                    }
                                }
                                else
                                {
                                    return response(['status'=>'401','Message'=>"Campaign is not started yet"]);
                                }
                                
                            }
                            else
                            {
                                /*Language wise msg set*/
                                if(!empty($request->language_id) && $request->language_id == '1')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_eng;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '2')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_albanian;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '3')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_greek;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '4')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_italian;
                                }
                                else
                                {
                                    $voucher_msg = "Pass language id";
                                }
                                return response(['status'=>'401','Message'=>$voucher_msg]);
                            }
                        }    
                        else
                        {
                            return response(['status'=>'401','Message'=>"Voucher Expired"]);
                        }
                    }
                    else
                    {
                        return response(['status'=>'401','Message'=>"Voucher Doesn't Start Yet"]);            
                    }
                }
                else
                {
                    return response(['status'=>'401','Message'=>"the code doesn't exist"]);            
                }
            }
            else
            {
                if(!empty($voucher_details) && $voucher_details->code === $input['code'])
                {
                    //echo "string"; exit;
                
                    if($todayDate >= $voucher_details->start_date )
                    {
                        if($todayDate <= $voucher_details->end_date )
                        {
                            //echo "string"; exit; 
                                //echo $voucher_details->code_status; exit;
                            if($voucher_details->code_status == '0' )
                            {  
                                //echo "string"; exit;
                                $business_details = \App\Models\Brand::where('id',$voucher_details->business_id)->first();
                                $businessPoints = \App\Models\Points_master::where('business_id',$business_details->id)->first();
                                if(!empty($businessPoints))
                                {
                                    $input['points'] = $businessPoints->welcome_point;
                                }
                                else
                                {
                                    $input['stamps'] = '1';
                                }
                                $input['voucher_id'] = $voucher_details->id;
                                $input['used_code_status'] = 0;
                                
                                $userVoucher = $this->userVoucherRepository->create($input);                
                                //$data['voucher_id'] = $voucher_details->id;
                                $data['code_status'] = 1;
                                $voucherUpdate = \App\Models\Voucher::where('id',$voucher_details->id)->update($data);
                                //return $this->sendResponse(new User_voucherResource($userVoucher), 'you win a voucher of '.$voucher_details->code.' and create the voucher (wallet)');
                                /*Purches Option edit status*/
                                if($request->option == 'BUY')
                                {
                                    $update_status = \App\Models\Purchase_options::where('v_code',$request->code)
                                                        ->update(['code_status' => '1']);
                                    $get_point = \App\Models\Purchase_options::where('v_code',$request->code)
                                                        ->first();

                                    $buss_id = \App\User::where('id',$request->user_id)->select('userDetailsId')->first();
                                    $buss_point_s = \App\Models\My_rewards::where('my_rewards.buss_id',$voucher_details->business_id)
                                                                    ->where('user_id',$request->user_id)
                                                                    ->sum('point_per_stamp');

                                    $buss_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$voucher_details->business_id)
                                                ->where('user_id',$get_point->user_id)
                                                ->select('bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point')
                                                ->first();

                                    /*echo "<pre>";
                                    print_r($buss_point_s); exit;*/
                                    if($business_details->type == '2')
                                    {
                                        
                                      $all_point = @$buss_point->total_point - @$get_point->points;

                                      $buss_point_update = \App\Models\Bussiness_wise_stamp_point::where('business_id',$voucher_details->business_id)
                                                                            ->where('user_id',$request->user_id)
                                                                            ->update(['total_point' => $all_point]);
                                    }else{
                                        $all_point = @$buss_point_s - @$get_point->points;
                                        $buss_point_update = \App\Models\My_rewards::where('buss_id',$voucher_details->business_id)
                                                                            ->where('user_id',$request->user_id)
                                                                            ->update(['point_per_stamp' => $all_point]);
                                    }

                                   //echo $update_status; exit;
                                }
                                /*End*/
                                

                                /*Language wise msg set*/
                                if(!empty($request->language_id) && $request->language_id == '1')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_eng;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '2')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_albanian;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '3')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_greek;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '4')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_italian;
                                }
                                else
                                {
                                    $voucher_msg = "Pass language id";
                                }

                                return response(['status'=>'200','Message'=> $voucher_msg]);
                            }
                            else
                            {
                                /*Language wise msg set*/
                                if(!empty($request->language_id) && $request->language_id == '1')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_eng;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '2')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_albanian;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '3')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_greek;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '4')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_italian;
                                }
                                else
                                {
                                    $voucher_msg = "Pass language id";
                                }
                                return response(['status'=>'401','Message'=>$voucher_msg]);
                                //return response(['status'=>'401','Message'=>"Voucher is already used"]);
                            }
                        }    
                        else
                        {
                            return response(['status'=>'401','Message'=>"Voucher Expired"]);
                        }
                    }
                    else
                    {
                        return response(['status'=>'401','Message'=>"Voucher Doesn't Start Yet"]);
                    }
                }
                else
                {
                    return response(['status'=>'401','Message'=>"the code doesn't exist"]);            
                }
            }
        }
       
        else
        {
            return response(['status'=>'401','Message'=>"the code doesn't exist"]);
        }

    }

    /*super_deal_scan*/
    public function super_deal_scan(Request $request)
   {
        $input = $request->all();
        
        $voucher_details = \App\Models\Voucher::where('code',$input['code'])->first();
       /*  echo "<pre>";
         print_r($voucher_details); exit;
*/
        if(!empty($voucher_details) && $voucher_details->code != '')
        {
            
            $todayDate = date('Y-m-d');
            if($voucher_details->category_id == '2')
            {
                
                if(!empty($voucher_details) && $voucher_details->code === $input['code'])
                {
                
                    if($todayDate >= $voucher_details->start_date )
                    {
                        if($todayDate <= $voucher_details->end_date )
                        {
                            if($voucher_details->code_status == '0' )
                            {   
                                $business_details = \App\Models\Brand::where('id',$voucher_details->business_id)->first();
                                $businessPoints = \App\Models\Points_master::where('business_id',$business_details->id)->first();
                                if(!empty($businessPoints))
                                {
                                    $input['points'] = $businessPoints->welcome_point;
                                }
                                else
                                {
                                    $input['stamps'] = '1';
                                }
                                $input['voucher_id'] = $voucher_details->id;
                                $input['used_code_status'] = 1;
                                
                                $userVoucher = $this->userVoucherRepository->create($input);                
                                //$data['voucher_id'] = $voucher_details->id;
                                $data['code_status'] = 1;
                                $voucherUpdate = \App\Models\Voucher::where('id',$voucher_details->id)->update($data);

                                /*rewards part*/
                                 $check = \App\Models\My_rewards::where('user_id',$request->user_id)->first();
                                 $transaction_type = \App\User::where('id',$request->user_id)->select('transaction_type')->first();
                                 /*transaction_history*/
                                    $credit1['user_id'] = $request->user_id;
                                    $credit1['nfc_code'] = $check['nfc_code'];
                                    $credit1['buss_id'] = $check['buss_id'];
                                    $credit1['stamps'] = $check['stamps'];
                                    $credit1['setup_level'] = $check['setup_level'];
                                    $credit1['point_per_stamp'] = $check['point_per_stamp'];
                                    $credit1['transaction_type_id'] = $transaction_type['transaction_type'];
                                    $credit1['type'] = $request->type;
                                    $transaction_history = \App\Models\Transaction_history::create($credit1);
                                /*Update rewards*/
                                if($request->type = 1 && $businessPoints->schema != 2){
                                    
                                     $points_upadte = \App\User::where('id',$request->user_id)->update(['point' => '0']);
                                }

                                if($request->type = 2)
                                {
                                    $credit['stamps'] = 0;
                                    $credit['point_per_stamp'] = 0;
                                    $rewards = \App\Models\My_rewards::where('user_id',$request->user_id)->update($credit);
                                }

                                /*Purches Option edit status*/
                                if($request->option == 'BUY')
                                {
                                   $update_status = \App\Models\Purchase_options::whereIn('v_code',$request->code)
                                                        ->update(['code_status' => '1']);
                                }
                                /*End*/
                                //return $this->sendResponse(new User_voucherResource($userVoucher), 'you win a voucher of '.$voucher_details->code.' and create the voucher (wallet)');
                                 /*Language wise msg set*/
                                if(!empty($request->language_id) && $request->language_id == '1')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_eng;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '2')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_albanian;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '3')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_greek;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '4')
                                {
                                    $voucher_msg = $voucher_details->text_for_win_code_italian;
                                }
                                else
                                {
                                    $voucher_msg = "Pass language id";
                                }

                                return response(['status'=>'200','Message'=> $voucher_msg]);
                            }
                            else
                            {
                                /*Language wise msg set*/
                                if(!empty($request->language_id) && $request->language_id == '1')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_eng;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '2')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_albanian;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '3')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_greek;
                                }
                                else if(!empty($request->language_id) && $request->language_id == '4')
                                {
                                    $voucher_msg = $voucher_details->text_for_not_win_code_italian;
                                }
                                else
                                {
                                    $voucher_msg = "Pass language id";
                                }
                                return response(['status'=>'401','Message'=>$voucher_msg]);
                                //return response(['status'=>'401','Message'=>"Voucher is already used"]);
                            }
                        }    
                        else
                        {
                            return response(['status'=>'401','Message'=>"Voucher Expired"]);
                        }
                    }
                    else
                    {
                        return response(['status'=>'401','Message'=>"Voucher Doesn't Start Yet"]);
                    }
                }
                else
                {
                    return response(['status'=>'401','Message'=>"the code doesn't exist"]);            
                }
            }
        }
       
        else
        {
            return response(['status'=>'401','Message'=>"the code doesn't exist"]);
        }

    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userVouchers/{id}",
     *      summary="Display the specified User_voucher",
     *      tags={"User_voucher"},
     *      description="Get User_voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User_voucher",
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
     *                  ref="#/definitions/User_voucher"
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
        /** @var User_voucher $userVoucher */
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            return $this->sendError('User Voucher not found');
        }

        return $this->sendResponse(new User_voucherResource($userVoucher), 'User Voucher retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUser_voucherAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/userVouchers/{id}",
     *      summary="Update the specified User_voucher in storage",
     *      tags={"User_voucher"},
     *      description="Update User_voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User_voucher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User_voucher that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User_voucher")
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
     *                  ref="#/definitions/User_voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUser_voucherAPIRequest $request)
    {
        $input = $request->all();

        /** @var User_voucher $userVoucher */
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            return $this->sendError('User Voucher not found');
        }

        $userVoucher = $this->userVoucherRepository->update($input, $id);

        return $this->sendResponse(new User_voucherResource($userVoucher), 'User_voucher updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/userVouchers/{id}",
     *      summary="Remove the specified User_voucher from storage",
     *      tags={"User_voucher"},
     *      description="Delete User_voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User_voucher",
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
        /** @var User_voucher $userVoucher */
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            return $this->sendError('User Voucher not found');
        }

        $userVoucher->delete();

        return $this->sendSuccess('User Voucher deleted successfully');
    }
}
