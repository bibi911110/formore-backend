<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMember_ordersAPIRequest;
use App\Http\Requests\API\UpdateMember_ordersAPIRequest;
use App\Models\Member_orders;
use App\Repositories\Member_ordersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Member_ordersResource;
use Response;

/**
 * Class Member_ordersController
 * @package App\Http\Controllers\API
 */

class Member_ordersAPIController extends AppBaseController
{
    /** @var  Member_ordersRepository */
    private $memberOrdersRepository;

    public function __construct(Member_ordersRepository $memberOrdersRepo)
    {
        $this->memberOrdersRepository = $memberOrdersRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/memberOrders",
     *      summary="Get a listing of the Member_orders.",
     *      tags={"Member_orders"},
     *      description="Get all Member_orders",
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
     *                  @SWG\Items(ref="#/definitions/Member_orders")
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
        $memberOrders = $this->memberOrdersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Member_ordersResource::collection($memberOrders), 'Member Orders retrieved successfully');
    }

    /**
     * @param CreateMember_ordersAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/memberOrders",
     *      summary="Store a newly created Member_orders in storage",
     *      tags={"Member_orders"},
     *      description="Store Member_orders",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Member_orders that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Member_orders")
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
     *                  ref="#/definitions/Member_orders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    public function member_orders_user_view(Request $request)
    {

         $member_orders_user_view = \App\Models\Member_orders::where('member_orders.member_id', $request->user_id)
                                    ->leftjoin('users','member_orders.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('member_orders.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('member_orders.order_id',"DESC")
                                    ->get();
         if($member_orders_user_view != ''){
            return response(['status'=>'200','Message'=>'Member Orders retrieved successfully','member_orders_user_view' => $member_orders_user_view]);

        }else{
            return response(['status'=>'401','Message'=>"Member Orders not retrieved successfully"]);

        }

    }

    public function orders_buss_wise_view(Request $request)
    {

         $orders_buss_wise_view = \App\Models\Member_orders::where('member_orders.created_by', $request->buss_id)
                                    ->leftjoin('users','member_orders.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('member_orders.*','brand.name as brandName','brand.brand_icon')
                                     ->orderBy('member_orders.order_id',"DESC")
                                    ->get();
         if($orders_buss_wise_view != ''){
            return response(['status'=>'200','Message'=>'Member Orders retrieved successfully','orders_buss_wise_view' => $orders_buss_wise_view]);

        }else{
            return response(['status'=>'401','Message'=>"Member Orders not retrieved successfully"]);

        }

    }

    public function orders_user_buss_wise_view(Request $request)
    {

         $orders_user_buss_wise_view = \App\Models\Member_orders::where('member_orders.member_id', $request->user_id)
                                    ->where('member_orders.created_by', $request->buss_id)
                                    ->leftjoin('users','member_orders.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('member_orders.*','brand.name as brandName','brand.brand_icon')
                                    ->orderBy('member_orders.order_id',"DESC")
                                    ->get();
         if($orders_user_buss_wise_view != ''){
            return response(['status'=>'200','Message'=>'Member Orders retrieved successfully','orders_user_buss_wise_view' => $orders_user_buss_wise_view]);

        }else{
            return response(['status'=>'401','Message'=>"Member Orders not retrieved successfully"]);

        }

    }

     public function orders_details_view(Request $request)
    {

         $orders_details_view = \App\Models\Member_orders::where('member_orders.id', $request->order_id)
                                    ->leftjoin('users','member_orders.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->select('member_orders.*','brand.name as brandName','brand.brand_icon')
                                    ->get();

        $count = 0;
        foreach ($orders_details_view as $value) {

         $cart_extra_details = \App\Models\Order_products_details::leftjoin('order_products','order_products_details.product_id','order_products.id')
                                                ->where('order_products_details.order_id',$value->id)
                                               ->where('order_products_details.type','1')
                                              // ->groupBy('order_product_extra_details.id')
                                               ->select('order_products_details.*','order_products.name as product_name')
                                               ->get();


      /* $notInterestedJob = \App\Models\Order_cart_extra_details::where('order_id',$value->id)->pluck('product_id')->all();


       $product = \App\Models\Order_products::leftjoin('add_cart_final','order_products.id','add_cart_final.product_id_no_extra')
                                        ->select('order_products.id','order_products.name as product_name')
                                        ->where('add_cart_final.order_id',$value->id)->get();*/

            
        $orders_details_view[$count] = $value;
        $orders_details_view[$count]['cart_extra_details'] = $cart_extra_details;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        }                           
        if($orders_details_view != ''){
            return response(['status'=>'200','Message'=>'Member Orders retrieved successfully','orders_details_view' => $orders_details_view]);

        }else{
            return response(['status'=>'401','Message'=>"Member Orders not retrieved successfully"]);

        }

    }

    public function store(CreateMember_ordersAPIRequest $request)
    {
        $input = $request->all();
        /*echo "<pre>";
        print_r($input); exit;*/
        $last_order =  Member_orders::orderBy('id','DESC')->select('order_id')->first();
        if(!empty($last_order)){
            $input['order_id'] = $last_order->order_id + 1;
        }else{

            $input['order_id'] =  1;
        }
        $memberOrders = $this->memberOrdersRepository->create($input);

        if($request->advance_payment == 'yes')
        {
            $fetch_buss_id = \App\User::where('id',$request->created_by)->select('userDetailsId')->first();

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
            if($request->advance_payment == 'yes')
            {
              //echo "dd"; exit;
                //$all_point = @$buss_point->total_point - @$request->finalpoints;
               //echo $all_point; exit;
                /*$buss_point_update = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id->userDetailsId)
                                                    ->where('user_id',$request->user_id)
                                                    ->update(['total_point' => $all_point]);*/
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
            }/*else {
                //$all_point = @$buss_point_s - @$request->finalpoints;
                 //echo $buss_id->userDetailsId; exit;
                $buss_point_update = \App\Models\My_rewards::where('buss_id',$buss_id->userDetailsId)
                                                    ->where('user_id',$request->user_id)
                                                    ->update(['point_per_stamp' => $all_point]);
            }*/
            

        }

        $order_id = Member_orders::orderBy('id','DESC')->first();
        for ($i=0; $i<count($request->product_id); $i++) {           
        $input_data['product_id'] = $request->product_id[$i];
        $input_data['order_id'] = $order_id->id;
        $extra = \App\Models\Order_addcart_product::create($input_data);                
        }

        if($memberOrders != ''){

            $cart_extra_get = \App\Models\Cart_extra_details::where('type', 1)->where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->get();
            
            foreach ($cart_extra_get as $value) {
                $requestData= ([
                        'order_id'    => $order_id->id,
                        'type'      => '1',
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

            for ($i=0; $i<count($request->product_id); $i++) {           
            $input_data['product_id'] = $request->product_id[$i];
            $input_data['order_id'] = $order_id->id;
            $extra = \App\Models\Order_addcart_product_final::create($input_data);
            }
                

            for ($i=0; $i<count($request->product_id); $i++) {           
            $input_data_details['product_id'] = $request->product_id[$i];
            $input_data_details['product_name_extra'] = $request->product_name_extra[$i];
            $input_data_details['order_id'] = $order_id->id;
            $input_data_details['type'] = 1;
            $extra = \App\Models\Order_products_details::create($input_data_details);
                
            }
        
            $data = Date('Y-m-d : h:s:i');
            $cart = \App\Models\Add_cart::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
           
            $cart_extra = \App\Models\Cart_extra_details::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);

            $Order_addcart_product = \App\Models\Order_addcart_product::whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);

            $notification['business_id'] =  $request->created_by;
            $notification['slug'] = "order";
            $notification['message'] = "new order request";
            $addNotification = \App\Models\Notification_all_count::create($notification);


            if(!empty($business_user))
            {
                foreach ($business_user as $buss_user) {
                    $notificationUser['business_id'] =  $request->created_by;
                    $notificationUser['business_user_id'] =  $buss_user['id'];
                    $notificationUser['slug'] = "order";
                    $notificationUser['message'] = "new order request";
                    $addNotificationUser = \App\Models\Notification_all_child::create($notificationUser);                    
                }
            }


            return response(['status'=>'200','Message'=>'Order added successfully.','memberOrders' => $memberOrders]);

        }else{
            return response(['status'=>'401','Message'=>"Order not added"]);

        }

        //return $this->sendResponse(new Member_ordersResource($memberOrders), 'Member Orders saved successfully');
    }
    public function cart_delete(Request $request)
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

    public function add_cart(Request $request)
    {
        //echo "dd0"; exit;
        $input = $request->all();

        $add_cart = \App\Models\Add_cart::create($input);
        $add_cart_data = \App\Models\Add_cart::orderBy('id','DESC')->first();
        if($add_cart != ''){
            return response(['status'=>'200','Message'=>'Cart data added successfully.','add_cart_data' =>$add_cart_data]);

        }else{
            return response(['status'=>'401','Message'=>"Cart data not added"]);

        }
    }

    public function view_cart(Request $request)
    {
       /* $view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        ->leftjoin('cart_extra_details','add_cart.user_id','cart_extra_details.user_id')
                                        ->select('cart_extra_details.*','add_cart.business_id','add_cart.cat_id','add_cart.product_id')
                                        ->get();*/
         $view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        //->where('add_cart.product_id',$request->product_id)
                                        ->leftjoin('users','add_cart.business_id','users.id')
                                        ->leftjoin('brand','users.userDetailsId','brand.id')
                                        ->leftjoin('currency','brand.currency','currency.id')
                                        ->leftjoin('order_products','add_cart.product_id','order_products.id')
                                        ->select('add_cart.*','order_products.name','order_products.product_img','order_products.available_quantities','order_products.points_per_quantity','order_products.price_per_quantity','currency.currency_code','currency.currency_name')
                                        ->get();
         $count = 0;
        foreach ($view_cart as $value) {

            $extra_details = \App\Models\Cart_extra_details::where('cart_id', $value->id)->get();
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

    public function view_cart_product_wise(Request $request)
    {
        $view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        ->where('add_cart.product_id',$request->product_id)
                                        ->leftjoin('order_products','add_cart.product_id','order_products.id')
                                        ->select('add_cart.*','order_products.name','order_products.product_img','order_products.available_quantities','order_products.points_per_quantity','order_products.price_per_quantity')
                                        ->get();
         $count = 0;
        foreach ($view_cart as $value) {

            $extra_details = \App\Models\Cart_extra_details::where('cart_id', $value->id)->where('type',1)->get();
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
    

    public function add_cart_extra_details(Request $request)
    {
        $add_cart = \App\Models\Add_cart::where('id',$request->cart_id)->first();
        if($request->type == 1)
        {
            
        for ($i=0; $i<count($request->extra_id); $i++) {
            $extra_order = \App\Models\Order_product_extra_details::where('id',$request->extra_id[$i])->first();
            $input_data['type'] = $request->type;
            $input_data['cart_id'] = $request->cart_id;
            $input_data['product_id'] = $extra_order->product_id;
            $input_data['name'] = $extra_order->name;
            $input_data['available_quantities'] = $extra_order->available_quantities;
            $input_data['points_per_quantity'] = $extra_order->points_per_quantity;
            $input_data['price_per_quantity'] = $extra_order->price_per_quantity;
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

    public function get_all_order(Request $request)
    {
        $buss_id = \App\User::where('id',$request->business_user_id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        /*echo "<pre>";
        print_r($business_id); exit;
        exit;*/
        //$business_id->id
        if($request->status == '')
        {
            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.created_by',$business_id->userDetailsId)->get();

        }
        else if($request->status == 1)
        {
            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','Open')->where('member_orders.created_by',$business_id->userDetailsId)->get();
        }
        else if($request->status == 2)
        {

            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','Preparing order')->where('member_orders.created_by',$business_id->userDetailsId)->get();
        }
        else if($request->status == 3)
        {
            
            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','For delivery')->where('member_orders.created_by',$business_id->userDetailsId)->get();
        }
        else if($request->status == 4)
        {

            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','Delivered')->where('member_orders.created_by',$business_id->userDetailsId)->get();
        }

        if($data != ''){
            return response(['status'=>'200','Message'=>'order retrieved successfully.','orders'=>$data]);

        }else{
            return response(['status'=>'401','Message'=>"Order not found"]);

        }
    }
    

    public function order_filter(Request $request)
    {
        $buss_id = \App\User::where('id',$request->business_user_id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        
        //$business_id->id
        $orders = \App\Models\Member_orders::orderBy('order_id','DESC');
        if($request->endDate != '')
        {
            $orders->whereBetween('member_orders.created_at', [$request->startDate, $request->endDate]);
        }
        if(isset($request->status) &&  $request->status == '2')
        {
            $orders->where('member_orders.status','Delivered');
        }
        if(isset($request->status) &&  $request->status == '3')
        {
            $orders->where('member_orders.status','Cancel');
        }
        
        $orders = $orders->where('member_orders.created_by',$business_id->userDetailsId)->get();
        if($orders != ''){
            return response(['status'=>'200','Message'=>'order retrieved successfully.','orders'=>$orders]);

        }else{
            return response(['status'=>'401','Message'=>"Order not found"]);

        }   
    }
    public function order_details(Request $request)
    {
       // $order = \App\Models\Member_orders::where('id',$request->order_id)->first();

        /*$view_cart = \App\Models\Add_cart::where('add_cart.user_id',$request->user_id)
                                        ->where('add_cart.type',$request->type)
                                        ->where('add_cart.business_id',$request->business_id)
                                        //->where('add_cart.product_id',$request->product_id)
                                        ->leftjoin('users','add_cart.business_id','users.id')
                                        ->leftjoin('brand','users.userDetailsId','brand.id')
                                        ->leftjoin('currency','brand.currency','currency.id')
                                        ->leftjoin('order_products','add_cart.product_id','order_products.id')
                                        ->select('add_cart.*','order_products.name','order_products.product_img','order_products.available_quantities','order_products.points_per_quantity','order_products.price_per_quantity','currency.currency_code','currency.currency_name')
                                        ->get();*/
         
            /*$extra_details = $order_extra = \App\Models\Order_products_details::where('order_id',$request->order_id)->select('product_name_extra')->get();
                
            $order['extra_details'] = $extra_details;*/

        $orders_details_view = \App\Models\Member_orders::where('member_orders.id', $request->order_id)
                                    ->leftjoin('users','member_orders.created_by','users.id')
                                    ->leftjoin('brand','users.userDetailsId','brand.id')
                                    ->leftjoin('currency','brand.currency','currency.id')
                                    ->select('member_orders.*','brand.name as brandName','brand.brand_icon','currency.currency_code','currency.currency_name')
                                    ->get();

        $count = 0;
        foreach ($orders_details_view as $value) {

         $cart_extra_details = \App\Models\Order_products_details::leftjoin('order_products','order_products_details.product_id','order_products.id')
                                                ->where('order_products_details.order_id',$value->id)
                                               ->where('order_products_details.type','1')
                                              // ->groupBy('order_product_extra_details.id')
                                               ->select('order_products_details.*','order_products.name as product_name')
                                               ->get();


      /* $notInterestedJob = \App\Models\Order_cart_extra_details::where('order_id',$value->id)->pluck('product_id')->all();


       $product = \App\Models\Order_products::leftjoin('add_cart_final','order_products.id','add_cart_final.product_id_no_extra')
                                        ->select('order_products.id','order_products.name as product_name')
                                        ->where('add_cart_final.order_id',$value->id)->get();*/

            
        $orders_details_view[$count] = $value;
        $orders_details_view[$count]['cart_extra_details'] = $cart_extra_details;
       // $orders_details_view[$count]['product'] = $product;
        $count++;
                

       
         }

        if($orders_details_view != ''){
            return response(['status'=>'200','Message'=>'order retrieved successfully.','orders'=>$orders_details_view]);

        }else{
            return response(['status'=>'401','Message'=>"Order not found"]);

        }      
    }
    public function update_order_status(Request $request)
    {
        $order = \App\Models\Member_orders::where('id',$request->order_id)->update(['status'=> $request->status]);

        $order = \App\Models\Member_orders::where('id',$request->order_id)->first();

        $firebaseToken = \App\User::where('users.role_id',4)->where('users.id',$order->member_id)->whereNotNull('device_token')->pluck('device_token')->all();
        
        $order_data = \App\Models\Member_orders::where('id',$request->order_id)->first();
        $buss_name = \App\User::where('id',$order_data->created_by)->first();

        //where('id',14)
        if($request->status == 'Open')
        {
            $message = "Thank you. Your order at ".@$buss_name['name']." is successfully placed.";
        }
        else if($order_data->storepick == true && $request->status == 'Preparing order' )
        {
            $message = "Your order at ".@$buss_name['name']." is being prepared, you are welcome to take it";
        }
        else if($request->status == 'For delivery' )
        {
            $message = "Your order at ".@$buss_name['name']." is ready for delivery. Please patiently wait for the courier call";
        }
        else if($request->status == 'Delivered' )
        {
            $message = "Your order at ".@$buss_name['name']." is successfully delivered, enjoy your food.";
        }
        else if($request->status == 'Cancel' )
        {
            $message = "Your order at ".@$buss_name['name']." is being cancelled.";
        }

        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Order",
                "message" => "Order status has been changed by business..",
                "body" => $message,
                "member_id" =>$order->member_id,

            ], 
            "data" => [
                "buss_id" =>$order->member_id,
                "message" => $message,
                "type" => "Order",
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
        if($order != ''){
            return response(['status'=>'200','Message'=>'order update successfully.']);

        }else{
            return response(['status'=>'401','Message'=>"Order not updated"]);
        }         
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/memberOrders/{id}",
     *      summary="Display the specified Member_orders",
     *      tags={"Member_orders"},
     *      description="Get Member_orders",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Member_orders",
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
     *                  ref="#/definitions/Member_orders"
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
        /** @var Member_orders $memberOrders */
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            return $this->sendError('Member Orders not found');
        }

        return $this->sendResponse(new Member_ordersResource($memberOrders), 'Member Orders retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMember_ordersAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/memberOrders/{id}",
     *      summary="Update the specified Member_orders in storage",
     *      tags={"Member_orders"},
     *      description="Update Member_orders",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Member_orders",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Member_orders that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Member_orders")
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
     *                  ref="#/definitions/Member_orders"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMember_ordersAPIRequest $request)
    {
        $input = $request->all();

        /** @var Member_orders $memberOrders */
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            return $this->sendError('Member Orders not found');
        }

        $memberOrders = $this->memberOrdersRepository->update($input, $id);

        return $this->sendResponse(new Member_ordersResource($memberOrders), 'Member_orders updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/memberOrders/{id}",
     *      summary="Remove the specified Member_orders from storage",
     *      tags={"Member_orders"},
     *      description="Delete Member_orders",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Member_orders",
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
        /** @var Member_orders $memberOrders */
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            return $this->sendError('Member Orders not found');
        }

        $memberOrders->delete();

        return $this->sendSuccess('Member Orders deleted successfully');
    }
}
