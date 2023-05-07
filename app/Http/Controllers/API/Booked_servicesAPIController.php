<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBooked_servicesAPIRequest;
use App\Http\Requests\API\UpdateBooked_servicesAPIRequest;
use App\Models\Booked_services;
use App\Repositories\Booked_servicesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Booked_servicesResource;
use Response;
use Carbon\Carbon;


/**
 * Class Booked_servicesController
 * @package App\Http\Controllers\API
 */

class Booked_servicesAPIController extends AppBaseController
{
    /** @var  Booked_servicesRepository */
    private $bookedServicesRepository;

    public function __construct(Booked_servicesRepository $bookedServicesRepo)
    {
        $this->bookedServicesRepository = $bookedServicesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/bookedServices",
     *      summary="Get a listing of the Booked_services.",
     *      tags={"Booked_services"},
     *      description="Get all Booked_services",
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
     *                  @SWG\Items(ref="#/definitions/Booked_services")
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
        $bookedServices = $this->bookedServicesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Booked_servicesResource::collection($bookedServices), 'Booked Services retrieved successfully');
    }

    /**
     * @param CreateBooked_servicesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/bookedServices",
     *      summary="Store a newly created Booked_services in storage",
     *      tags={"Booked_services"},
     *      description="Store Booked_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Booked_services that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Booked_services")
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
     *                  ref="#/definitions/Booked_services"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBooked_servicesAPIRequest $request)
    {
        $input = $request->all();

        $last_order =  Booked_services::where('created_by',$request->created_by)->orderBy('id','DESC')->select('booking_id')->first();
        if(!empty($last_order)){
            $input['booking_id'] = $last_order->booking_id + 1;
        }else{

            $input['booking_id'] =  1;
        }
        $input['booking_service_date_time'] = date('Y-m-d');


        $bookedServices = $this->bookedServicesRepository->create($input);
        if($request->advance_payment == 'yes'){

        $buss_id = \App\User::where('id',$request->created_by)->select('userDetailsId')->first();

        $business_user = \App\User::where('created_by',$buss_id->userDetailsId)->get();
        
        $user_points = \App\User::where('id',$request->user_id)->first();

        $buss_point_s = \App\Models\My_rewards::where('my_rewards.buss_id',$buss_id->userDetailsId)->where('user_id',$request->user_id)->sum('point_per_stamp');



        $buss_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id->userDetailsId)
                                                ->where('user_id',$request->user_id)
                                                ->select('bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point')
                                                ->first();
            /*$user_data = \App\User::where('id',$request->member_id)->first();
            $f_point = $user_data->point - $request->finalpoints;
            \App\User::where('id',$request->member_id)->update(['point' => $f_point]);*/
            $business_details = \App\Models\Brand::where('id',$buss_id->userDetailsId)->first();
            if($business_details->type == '2')
            {
                
              $all_point = @$buss_point->total_point - @$request->finalpoints;
               //echo $all_point; exit;
              $buss_point_update = \App\Models\Bussiness_wise_stamp_point::where('business_id',$$buss_id->userDetailsId)
                                                    ->where('user_id',$request->user_id)
                                                    ->update(['total_point' => $all_point]);
            }else{
                $all_point = @$buss_point_s - @$request->finalpoints;
                 //echo $buss_id->userDetailsId; exit;
                $buss_point_update = \App\Models\My_rewards::where('buss_id',$buss_id->userDetailsId)
                                                    ->where('user_id',$request->user_id)
                                                    ->update(['point_per_stamp' => $all_point]);
            }
            $fetch_buss_id = \App\User::where('id',$request->created_by)->select('userDetailsId')->first();
            $fetch_point = \App\Models\Bussiness_wise_stamp_point::where('user_id',$request->member_id)
                                                                 ->where('business_id',$fetch_buss_id->userDetailsId)
                                                                 ->select('total_point')
                                                                 ->first();
            if(isset($fetch_point->total_point))
            {
                $total_points = $fetch_point->total_point - $request->finalpoints;
                $fetch_point = \App\Models\Bussiness_wise_stamp_point::where('user_id',$request->member_id)
                                                                 ->where('business_id',$fetch_buss_id->userDetailsId)
                                                                 ->update(['total_point' => $total_points]);
            }
        }
        $booking_id = Booked_services::orderBy('id','DESC')->first();
           for ($i=0; $i<count($request->product_id); $i++) {           
            $input_data['product_id'] = $request->product_id[$i];            
            $input_data['booking_id'] = $booking_id->id;
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
                        'name'      => $value->name,
                        'available_quantities'      => $value->available_quantities,
                        'points_per_quantity'      => $value->points_per_quantity,
                        'price_per_quantity'      => $value->price_per_quantity,
                        'quantity'      => $value->quantity,
                        'user_id'      => $value->user_id,
                       ]);
                //$value['order_id'] = $order_id->id;
                $orde_extra_add = \App\Models\Order_cart_extra_details::create($requestData);
            }

            $Booking_add_cart_time = \App\Models\Booking_add_cart_time::whereIn('add_cart_id',$request->cart_id)->whereIn('product_id',$request->product_id)->get();
           
            foreach ($Booking_add_cart_time as $value1) {
                    $requestData= ([
                            'booking_id'    => $booking_id->id,
                            'time'      => $value1->time,
                            'product_id'      => $value1->product_id,
                            'add_cart_id'      => $value1->add_cart_id,
                            'date'      => $value1->date,
                            'business_id'      => $request->created_by,
                            'slot_id' => $value1->slot_id,
                            'user_id'      => $request->user_id,
                            ]);
                    $orde_extra_add = \App\Models\Booking_add_cart_time_order::create($requestData);
                    \App\Models\Booked_services::where('id',$booking_id->id)
                    ->update(['service_name' => $value1->product_id]);
            }

            for ($i=0; $i<count($request->product_id); $i++) {           
            $input_data_details['product_id'] = $request->product_id[$i];
            $input_data_details['product_name_extra'] = $request->product_name_extra[$i];
            $input_data_details['booking_id'] = $booking_id->id;
            $input_data_details['type'] = 2;
            $input_data_details['booking_date'] = $request->booking_date[$i];
            $input_data_details['product_time_array'] = $request->product_time_array[$i];
            $extra = \App\Models\Booked_services_details::create($input_data_details);
                
            }


            $data = Date('Y-m-d : h:s:i');
            $cart = \App\Models\Add_cart::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
            $cart_extra = \App\Models\Cart_extra_details::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
            $Booking_addcart_product = \App\Models\Booking_addcart_product::whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);

            $notification['business_id'] =  $request->created_by;
            $notification['slug'] = "appointment";
            $notification['message'] = "new booking request";
            $addNotification = \App\Models\Notification_all_count::create($notification);


            if(!empty($business_user))
            {
                foreach ($business_user as $buss_user) {
                    $notificationUser['business_id'] =  $request->created_by;
                    $notificationUser['business_user_id'] =  $buss_user['id'];
                    $notificationUser['slug'] = "appointment";
                    $notificationUser['message'] = "new booking request";
                    $addNotificationUser = \App\Models\Notification_all_child::create($notificationUser);                    
                }
            }

            return response(['status'=>'200','Message'=>'Booking added successfully.','bookedServices' => $bookedServices]);

        }else{
            return response(['status'=>'401','Message'=>"Booking not added"]);

        }

        //return $this->sendResponse(new Booked_servicesResource($bookedServices), 'Booked Services saved successfully');
    }

    public function booking_add_cart(Request $request)
    {
        //echo "dd0"; exit;
        $input = $request->all();

        $add_cart = \App\Models\Add_cart::create($input);

        $booking_id = \App\Models\Add_cart::orderBy('id','DESC')->first();
           for ($i=0; $i<count($request->time); $i++) {           
            $input_data['time'] = $request->time[$i];
            $input_data['add_cart_id'] = $booking_id->id;
            $input_data['product_id'] = $booking_id->product_id;
            $input_data['date'] = $request->date;
            $input_data['business_id'] = $booking_id->business_id;
            $input_data['slot_id'] = $request->slot_id[$i];
            $extra = \App\Models\Booking_add_cart_time::create($input_data);
                
        }
        $add_cart_data = \App\Models\Add_cart::orderBy('add_cart.id','DESC')->first();
        if($add_cart != ''){
            return response(['status'=>'200','Message'=>'Booking Cart data added successfully.','add_cart_data' =>$add_cart_data]);

        }else{
            return response(['status'=>'401','Message'=>"Booking Cart data not added"]);

        }
    }

    public function active_apportionment_view(Request $request)
    {
        $booking_user_view = \App\Models\Booked_services::whereDate('booked_services.created_at', Carbon::today())
                                    ->where('booked_services.member_id', $request->user_id)
                                    ->where('booked_services.status','!=','Cancel')
                                    ->leftjoin('users','booked_services.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('booked_services.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('booked_services.booking_id',"DESC")
                                    //->groupBy('booked_services.booking_id')
                                    ->get();
         $count = 0;
        foreach ($booking_user_view as $value) {

         $booking_slot = \App\Models\Booking_add_cart_time_order::where('booking_id',$value->id)
                                                                 ->get();

            
        $booking_user_view[$count] = $value;
        $booking_user_view[$count]['booking_slot'] = $booking_slot;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        } 
       
        if($booking_user_view != ''){
            return response(['status'=>'200','Message'=>'Booking active apportionment retrieved successfully','booking_user_view' => $booking_user_view]);

        }else{
            return response(['status'=>'401','Message'=>"Booking active apportionment not retrieved successfully"]);

        }
    }
    public function history_apportionment_view(Request $request)
    {
       
         $booking_user_view = \App\Models\Booked_services::whereDate('booked_services.created_at', '<', Carbon::today())
                                    ->where('booked_services.member_id', $request->user_id)
                                    ->leftjoin('users','booked_services.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('booked_services.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('booked_services.booking_id',"DESC")
                                    ->get();
         $count = 0;
        foreach ($booking_user_view as $value) {

         $booking_slot = \App\Models\Booking_add_cart_time_order::where('booking_id',$value->id)
                                                                 ->get();

            
        $booking_user_view[$count] = $value;
        $booking_user_view[$count]['booking_slot'] = $booking_slot;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        } 
        if($booking_user_view != ''){
            return response(['status'=>'200','Message'=>'Booking active apportionment retrieved successfully','booking_user_view' => $booking_user_view]);

        }else{
            return response(['status'=>'401','Message'=>"Booking active apportionment not retrieved successfully"]);

        }
    }

    public function booking_user_view(Request $request)
    {

         $booking_user_view = \App\Models\Booked_services::where('booked_services.member_id', $request->user_id)
                                    ->leftjoin('users','booked_services.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('booked_services.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('booked_services.booking_id',"DESC")
                                    ->get();
         $count = 0;
        foreach ($booking_user_view as $value) {

         $booking_slot = \App\Models\Booking_add_cart_time_order::where('booking_id',$value->id)
                                                                 ->get();

            
        $booking_user_view[$count] = $value;
        $booking_user_view[$count]['booking_slot'] = $booking_slot;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        } 

         if($booking_user_view != ''){
            return response(['status'=>'200','Message'=>'Booking retrieved successfully','booking_user_view' => $booking_user_view]);

        }else{
            return response(['status'=>'401','Message'=>"Booking not retrieved successfully"]);

        }

    }

    public function booking_buss_wise_view(Request $request)
    {

        $orders_buss_wise_view = \App\Models\Booked_services::where('booked_services.created_by', $request->buss_id)
                                    ->leftjoin('users','booked_services.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('booked_services.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('booked_services.booking_id',"DESC")
                                    ->get();


         $count = 0;
        foreach ($orders_buss_wise_view as $value) {

         $booking_slot = \App\Models\Booking_add_cart_time_order::where('booking_id',$value->id)
                                                                 ->get();

            
        $orders_buss_wise_view[$count] = $value;
        $orders_buss_wise_view[$count]['booking_slot'] = $booking_slot;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        } 
         if($orders_buss_wise_view != ''){
            return response(['status'=>'200','Message'=>'Booking retrieved successfully','orders_buss_wise_view' => $orders_buss_wise_view]);

        }else{
            return response(['status'=>'401','Message'=>"Booking not retrieved successfully"]);

        }

    }

     public function booking_user_buss_wise_view(Request $request)
    {

         $booking_user_buss_wise_view = \App\Models\Booked_services::where('booked_services.member_id', $request->user_id)
                                    ->where('booked_services.created_by', $request->buss_id)
                                    ->leftjoin('users','booked_services.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('booked_services.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('booked_services.booking_id',"DESC")
                                    ->get();
         if($booking_user_buss_wise_view != ''){
            return response(['status'=>'200','Message'=>'Member Orders retrieved successfully','booking_user_buss_wise_view' => $booking_user_buss_wise_view]);

        }else{
            return response(['status'=>'401','Message'=>"Member Orders not retrieved successfully"]);

        }

    }
    public function booking_details_view(Request $request)
    {

         $orders_details_view = \App\Models\Booked_services::where('booked_services.id', $request->booking_id)
                                    ->leftjoin('users','booked_services.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('booked_services.*','brand.name as brandName','brand.brand_icon')
                                    ->get();

        $count = 0;
        foreach ($orders_details_view as $value) {

         $cart_extra_details = \App\Models\Booked_services_details::leftjoin('services_product','booked_services_details.product_id','services_product.id')
                                                ->where('booked_services_details.booking_id',$value->id)
                                               ->where('booked_services_details.type','2')
                                              // ->groupBy('order_product_extra_details.id')
                                               ->select('booked_services_details.*','services_product.name as product_name')
                                               ->get();

        $booking_add_cart_time = \App\Models\Booking_add_cart_time_order::where('booking_id', $value->id)->get();  
        $orders_details_view[$count] = $value;
        $orders_details_view[$count]['cart_extra_details'] = $cart_extra_details;
        $orders_details_view[$count]['booking_add_cart_time'] = $booking_add_cart_time;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        }                           
        if($orders_details_view != ''){
            return response(['status'=>'200','Message'=>'Booking retrieved successfully','orders_details_view' => $orders_details_view]);

        }else{
            return response(['status'=>'401','Message'=>"Booking not retrieved successfully"]);

        }

    }



    public function booking_add_cart_extra_details(Request $request)
    {
        $extra = '';
        $add_cart = \App\Models\Add_cart::where('id',$request->cart_id)->first();
        if($request->type == 2)
        {
            for ($i=0; $i<count($request->extra_id); $i++) {
            $extra_order = \App\Models\Extra_services::where('id',$request->extra_id[$i])->first();
            $input_data['type'] = $request->type;
            $input_data['cart_id'] = $request->cart_id;
            $input_data['product_id'] = $extra_order->product_id;
            $input_data['name'] = $extra_order->services_name;
            //$input_data['available_quantities'] = $extra_order->available_quantities;
            $input_data['points_per_quantity'] = $extra_order->services_per_point;
            $input_data['price_per_quantity'] = $extra_order->services_per_price;
            $input_data['quantity'] = $request->quantity[$i];
            $input_data['extra_id'] = $request->extra_id[$i];
            $input_data['user_id'] = $request->user_id;
            $extra = \App\Models\Cart_extra_details::create($input_data);
                
            }
        }


        if($extra != ''){
            return response(['status'=>'200','Message'=>'Extra details data added successfully.']);

        }else{
            return response(['status'=>'401','Message'=>"Extra details data not added"]);

        }
    }

    public function booking_view_cart(Request $request)
    {
        /*$booking_view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        ->leftjoin('cart_extra_details','add_cart.user_id','cart_extra_details.user_id')
                                        ->select('cart_extra_details.*','add_cart.business_id','add_cart.cat_id')
                                        ->get();*/
        $booking_view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        //->where('add_cart.product_id',$request->product_id)
                                        ->leftjoin('users','add_cart.business_id','users.id')
                                        ->leftjoin('brand','users.userDetailsId','brand.id')
                                        ->leftjoin('currency','brand.currency','currency.id')
                                        ->leftjoin('services_product','add_cart.product_id','services_product.id')
                                        ->select('services_product.*','add_cart.business_id','add_cart.cat_id','add_cart.id as a_cart_id','currency.currency_code','currency.currency_name')
                                        ->get();
         $count = 0;
        foreach ($booking_view_cart as $value) {
            //echo $value->id;

            $extra_details = \App\Models\Cart_extra_details::where('cart_id', $value->a_cart_id)->get();
            $booking_add_cart_time = \App\Models\Booking_add_cart_time::where('add_cart_id', $value->a_cart_id)->get();
                $booking_view_cart[$count] = $value;
                $booking_view_cart[$count]['extra_details'] = $extra_details;
                $booking_view_cart[$count]['booking_add_cart_time'] = $booking_add_cart_time;
                $count++;

        }
        //exit;

        if($booking_view_cart != ''){
            return response(['status'=>'200','Message'=>'Booking Cart data retrieved successfully.','booking_view_cart'=>$booking_view_cart]);

        }else{
            return response(['status'=>'401','Message'=>"Booking Cart data not retrieved"]);

        }
    }

     public function bookig_view_cart_product_wise(Request $request)
    {
        $view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        ->where('add_cart.product_id',$request->product_id)
                                        ->leftjoin('services_product','add_cart.product_id','services_product.id')
                                        ->select('add_cart.*','services_product.name','services_product.product_img','services_product.price_per_slot','services_product.point_per_slot')
                                        ->get();
         $count = 0;
        foreach ($view_cart as $value) {

            $extra_details = \App\Models\Cart_extra_details::where('cart_id', $value->id)->where('type',2)->get();
                $view_cart[$count] = $value;
                $view_cart[$count]['extra_details'] = $extra_details;
                $count++;

        }

        if($view_cart != ''){
            return response(['status'=>'200','Message'=>'Cart data retrieved successfully.','view_cart'=>$view_cart]);

        }else{
            return response(['status'=>'401','Message'=>"Cart data not retrieved"]);

        }
    }

    public function booking_cart_delete(Request $request)
    {
         $data = Date('Y-m-d : h:s:i');
            $cart = \App\Models\Add_cart::where('id', $request->cart_id)->update(['deleted_at' => $data]);
            $cart_extra = \App\Models\Cart_extra_details::where('cart_id', $request->cart_id)->update(['deleted_at' => $data]);
        if($cart != ''){
            return response(['status'=>'200','Message'=>'Cart item Delete successfully.']);

        }else{
            return response(['status'=>'401','Message'=>"Cart item not added"]);

        }

    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/bookedServices/{id}",
     *      summary="Display the specified Booked_services",
     *      tags={"Booked_services"},
     *      description="Get Booked_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Booked_services",
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
     *                  ref="#/definitions/Booked_services"
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
        /** @var Booked_services $bookedServices */
        $bookedServices = $this->bookedServicesRepository->find($id);

        if (empty($bookedServices)) {
            return $this->sendError('Booked Services not found');
        }

        return $this->sendResponse(new Booked_servicesResource($bookedServices), 'Booked Services retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBooked_servicesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/bookedServices/{id}",
     *      summary="Update the specified Booked_services in storage",
     *      tags={"Booked_services"},
     *      description="Update Booked_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Booked_services",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Booked_services that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Booked_services")
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
     *                  ref="#/definitions/Booked_services"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBooked_servicesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Booked_services $bookedServices */
        $bookedServices = $this->bookedServicesRepository->find($id);

        if (empty($bookedServices)) {
            return $this->sendError('Booked Services not found');
        }

        $bookedServices = $this->bookedServicesRepository->update($input, $id);

        return $this->sendResponse(new Booked_servicesResource($bookedServices), 'Booked_services updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/bookedServices/{id}",
     *      summary="Remove the specified Booked_services from storage",
     *      tags={"Booked_services"},
     *      description="Delete Booked_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Booked_services",
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
        /** @var Booked_services $bookedServices */
        $bookedServices = $this->bookedServicesRepository->find($id);

        if (empty($bookedServices)) {
            return $this->sendError('Booked Services not found');
        }

        $bookedServices->delete();

        return $this->sendSuccess('Booked Services deleted successfully');
    }
}
