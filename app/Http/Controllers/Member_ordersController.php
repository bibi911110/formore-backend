<?php

namespace App\Http\Controllers;

use App\DataTables\Member_ordersDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMember_ordersRequest;
use App\Http\Requests\UpdateMember_ordersRequest;
use App\Repositories\Member_ordersRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Member_ordersController extends AppBaseController
{
    /** @var  Member_ordersRepository */
    private $memberOrdersRepository;

    public function __construct(Member_ordersRepository $memberOrdersRepo)
    {
        $this->memberOrdersRepository = $memberOrdersRepo;

        $this->middleware('permission:member_orders-index|member_orders-create|member_orders-edit|member_orders-delete', ['only' => ['index','store']]);
        $this->middleware('permission:member_orders-create', ['only' => ['create','store']]);
        $this->middleware('permission:member_orders-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:member_orders-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Member_orders.
     *
     * @param Member_ordersDataTable $memberOrdersDataTable
     * @return Response
     */
    public function index(Member_ordersDataTable $memberOrdersDataTable)
    {
         $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.created_by',Auth::user()->id)->get();

            $notification = \App\Models\Notification_all_count::where('business_id',Auth::user()->id)
                    ->where('slug','order')
                    ->where('status',0)
                    ->get();            
            if(!empty($notification))
            {
                foreach ($notification as $value) {
                    $update['status'] = 1;
                    \App\Models\Notification_all_count::where('id',$value['id'])->update($update);

                }
                
            }
            return view('member_orders.index',compact('data'));
        // return $memberOrdersDataTable->render('member_orders.index');
    }

    /**
     * Show the form for creating a new Member_orders.
     *
     * @return Response
     */
    public function create()
    {
        return view('member_orders.create');
    }

    /**
     * Store a newly created Member_orders in storage.
     *
     * @param CreateMember_ordersRequest $request
     *
     * @return Response
     */
    public function store(CreateMember_ordersRequest $request)
    {
        $input = $request->all();

        $memberOrders = $this->memberOrdersRepository->create($input);

        Flash::success('Member Orders saved successfully.');

        return redirect(route('memberOrders.index'));
    }

    /**
     * Display the specified Member_orders.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            Flash::error('Member Orders not found');

            return redirect(route('memberOrders.index'));
        }

        return view('member_orders.show')->with('memberOrders', $memberOrders);
    }

    /**
     * Show the form for editing the specified Member_orders.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            Flash::error('Member Orders not found');

            return redirect(route('memberOrders.index'));
        }

        return view('member_orders.edit')->with('memberOrders', $memberOrders);
    }

    /**
     * Update the specified Member_orders in storage.
     *
     * @param  int              $id
     * @param UpdateMember_ordersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMember_ordersRequest $request)
    {
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            Flash::error('Member Orders not found');

            return redirect(route('memberOrders.index'));
        }

        $memberOrders = $this->memberOrdersRepository->update($request->all(), $id);


        $firebaseToken = \App\User::where('users.role_id',4)->where('users.id',$memberOrders->member_id)->whereNotNull('device_token')->pluck('device_token')->all();
        
        $order_data = \App\Models\Member_orders::where('id',$id)->first();
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
                "member_id" =>$memberOrders->member_id,

            ], 
            "data" => [
                "buss_id" =>$memberOrders->member_id,
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

        Flash::success('Order status has been changed by business..');

        return redirect(route('memberOrders.index'));
    }

    /**
     * Remove the specified Member_orders from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $memberOrders = $this->memberOrdersRepository->find($id);

        if (empty($memberOrders)) {
            Flash::error('Member Orders not found');

            return redirect(route('memberOrders.index'));
        }

        $this->memberOrdersRepository->delete($id);

        Flash::success('Member Orders deleted successfully.');

        return redirect(route('memberOrders.index'));
    }

    public function get_all_order($status = '' )
    {

        $buss_id = \App\User::where('id',Auth::user()->id)->first();
      /*  echo "<pre>";
        print_r($buss_id); exit;*/
        
        $business_id  = \App\User::where('business_id',$buss_id->business_id)->where('role_id','5')->first(); 
        /*echo "<pre>";
        print_r($business_id); exit;
        */
        //$business_id->id
        $notification = \App\Models\Notification_all_child::where('business_user_id',Auth::user()->id)
                    ->where('slug','order')
                    ->where('status',0)
                    ->get();            
            if(!empty($notification))
            {
                foreach ($notification as $value) {
                    $update['status'] = 1;
                    \App\Models\Notification_all_child::where('id',$value['id'])->update($update);

                }
                
            }

        if($status == '')
        {
            //echo $business_id->business_id; exit;
            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.created_by',$business_id->business_id)->get();
            /*echo "<pre>";
            print_r($data); exit;*/

        }
        else if($status == 1)
        {
            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','Open')->where('member_orders.created_by',$business_id->business_id)->get();
        }
        else if($status == 2)
        {

            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','Preparing order')->where('member_orders.created_by',$business_id->business_id)->get();
        }
        else if($status == 3)
        {
            
            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','For delivery')->where('member_orders.created_by',$business_id->business_id)->get();
        }
        else if($status == 4)
        {

            $data = \App\Models\Member_orders::orderBy('order_id','DESC')->where('member_orders.status','Delivered')->where('member_orders.created_by',$business_id->business_id)->get();
        }

            return view('member_orders.order_view',compact('data'));
        // return $memberOrdersDataTable->render('member_orders.index');
    }
    public function get_by_date()
    {
        

        return view('member_orders.all_orders');
    }
    public function search_orders( Request $request )
    {

        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('business_id',$buss_id->business_id)->where('role_id','5')->first(); 
        
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
        
        $orders = $orders->where('member_orders.created_by',$business_id->business_id)->get();
        //$account_details = $orders->where('order_status','Open')->paginate(5);
        $view = view('member_orders.order_table', ['data' => $orders])->render();
        return response()->json(['data' => $view]);
    }
    public function view_order_details($id)
    {
        $order = \App\Models\Member_orders::where('id',$id)->first();

        return view('member_orders.order_details',compact('order'));
    }
    public function update_order_status(Request $request)
    {
        $order = \App\Models\Member_orders::where('id',$request->id)->update(['status'=> $request->status]);

        $order_data = \App\Models\Member_orders::where('id',$request->id)->first();
        $buss_name = \App\User::where('id',$order_data->created_by)->first();

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

        $firebaseToken = \App\User::where('users.role_id',4)->where('users.id',$order_data->member_id)->whereNotNull('device_token')->pluck('device_token')->all();
        
        //where('id',14)

        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Order",
                "message" =>  $message,
                "body" => $message,
                "member_id" =>$order_data->member_id,

            ], 
            "data" => [
                "buss_id" =>$order_data->member_id,
                "message" =>  $message,
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
        if($order)
        {
            Flash::success('Member Orders updated successfully.');

            return redirect(route('get_by_date'));
        }
        else
        {
            Flash::error('Member Orders not updated successfully.');
            return back();
            
        }
    }
}
