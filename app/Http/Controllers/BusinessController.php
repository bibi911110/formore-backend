<?php

namespace App\Http\Controllers;

use App\DataTables\Voucher_upload_receiptDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVoucher_upload_receiptRequest;
use App\Http\Requests\UpdateVoucher_upload_receiptRequest;
use App\Repositories\Voucher_upload_receiptRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Exports\Upload_receipt_export;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Brand;
use App\Models\User_voucher;
use App\Helper\Email_master;
use DB;
use Carbon\Carbon;
use App\Http\Requests\API\CreateBooked_servicesAPIRequest;
use App\Http\Requests\API\UpdateBooked_servicesAPIRequest;
use App\Repositories\Booked_servicesRepository;
use App\Models\Booked_services;

class BusinessController extends AppBaseController
{
    /** @var  Voucher_upload_receiptRepository */
    //private $voucherUploadReceiptRepository;
    private $bookedServicesRepository;

    public function __construct(Booked_servicesRepository $bookedServicesRepo)
    {
        //$this->voucherUploadReceiptRepository = $voucherUploadReceiptRepo;
        $this->bookedServicesRepository = $bookedServicesRepo;

        $this->middleware('permission:voucher_upload_receipts-index|voucher_upload_receipts-create|voucher_upload_receipts-edit|voucher_upload_receipts-delete', ['only' => ['index','store']]);
        $this->middleware('permission:voucher_upload_receipts-create', ['only' => ['create','store']]);
        $this->middleware('permission:voucher_upload_receipts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:voucher_upload_receipts-delete', ['only' => ['destroy']]);
    }


    public function appointments_view()
    {  
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $notification = \App\Models\Notification_all_child::where('business_user_id',Auth::user()->id)
                    ->where('slug','appointment')
                    ->where('status',0)
                    ->get();            
            if(!empty($notification))
            {
                foreach ($notification as $value) {
                    $update['status'] = 1;
                    \App\Models\Notification_all_child::where('id',$value['id'])->update($update);

                }
                
            }

        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 
        //echo $business_id->id; exit;
        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$buss_id->business_id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();         
        return view('business.appointments_view',compact('book_slot'));
    }

     public function appointments_new()
    {  
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        /*$business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); */
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 
        //echo $business_id->id; exit;
        //echo $buss_id->business_id; exit;
        $book_slot = \App\Models\Slot_timing::where('booking_add_cart_time_order.business_id',$buss_id->business_id)
                            ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                            ->leftjoin('booked_services','booking_add_cart_time_order.booking_id','booked_services.id')
                            ->select('slot_timing.*','booking_add_cart_time_order.date',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'),'booking_add_cart_time_order.date')
                            ->where('booked_services.status','Open')
                            ->groupBy('slot_timing.id')
                            ->get(); 

        /*echo "<pre>";
        print_r($book_slot); exit;  */     
        return view('business.appointments_new',compact('book_slot'));
    }

    public function appointments_view_id_wise($id)
    {  
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*','booking_add_cart_time_order.date',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                               // ->where('booking_add_cart_time_order.user_id',$id)
                                                //->groupBy('slot_timing.id')
                                                ->get(); 

        return view('business.appointments_view',compact('book_slot'));
    }
    public function appointments_weekly_view()
    {  
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->whereBetween('booking_add_cart_time_order.date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();

        /*echo "<pre>";
        print_r($book_slot); exit;  */       
        return view('business.weekly_appointments_view',compact('book_slot'));
    }

    public function appointments_monthly_view()
    {  
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->whereMonth('booking_add_cart_time_order.date', Carbon::now()->month)
                                                //->whereBetween('booking_add_cart_time_order.date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();         
        return view('business.monthly_appointments_view',compact('book_slot'));
    }

    public function get_weekly_apointments()
    {
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->whereBetween('booking_add_cart_time_order.date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                //->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->groupBy('booking_add_cart_time_order.date')
                                                ->get(['slot_timing.id', 'slot_timing.slot_time as title','slot_timing.slot_time as time', 'booking_add_cart_time_order.date as start','booking_add_cart_time_order.date as end']);
        
        $events_array = [];
        foreach ($book_slot as $value) {
            $times_data = explode("-", $value->time);

            $events_array[] = array('id' =>$value->id,'title' => $value->title,"start" => $value->start.' '.str_replace(' ', '', $times_data[0]),'end'=>$value->end.str_replace(' ', '', $times_data[1]));
        }
        
        return response()->json($events_array); 
    }
    public function get_monthly_apointments()
    {
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->whereMonth('booking_add_cart_time_order.date', Carbon::now()->month)
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                //->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->groupBy('booking_add_cart_time_order.date')
                                                ->get(['slot_timing.id', 'slot_timing.slot_time as title','slot_timing.slot_time as time', 'booking_add_cart_time_order.date as start','booking_add_cart_time_order.date as end']);
        
        $events_array = [];
        foreach ($book_slot as $value) {
            $times_data = explode("-", $value->time);

            $events_array[] = array('id' =>$value->id,'title' => $value->title,"start" => $value->start.' '.str_replace(' ', '', $times_data[0]),'end'=>$value->end.str_replace(' ', '', $times_data[1]));
        }
        
        return response()->json($events_array); 
    }
    public function booked_appointment($appointmentId,$userId,$slot_id)
    {
        /*echo $appointmentId."<br>";
        echo $userId."<br>";*/
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 

        $appointmentDetails = \App\Models\Booked_services::where('id',$appointmentId)->first();
        $user_details = \App\User::where('id',$userId)->first();
        $slot_details = \App\Models\Slot_timing::where('id',$slot_id)->first();

        $services = \App\Models\Services_product::where('created_by',$business_id->id)->pluck('name','id');

        return view('business.edit_appointment',compact('appointmentDetails','user_details','services','slot_details'));

    }
    public function update_book_appointment(request $request)
    {
        $input = $request->all();

        $update_data['status']  =$input['status'];
        $update = \App\Models\Booked_services::where('id',$request->booking_id)->update($update_data);

        $order_data = \App\Models\Booked_services::where('id',$request->booking_id)->first();
        $buss_name = \App\User::where('id',$order_data->created_by)->first();

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

        $firebaseToken = \App\User::where('users.role_id',4)->where('users.id',$order_data->member_id)->whereNotNull('device_token')->pluck('device_token')->all();
        
        //where('id',14)

        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Appointment",
                "message" => "Appointment status has been changed by business..",
                "body" => $message,
                "member_id" =>$order_data->member_id,

            ], 
            "data" => [
                "buss_id" =>$order_data->member_id,
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
            Flash::success('Appointment Updated successfully');
            return redirect(url('appointments_view'));
        }
        else
        {
            Flash::error("Something went wrong");
            return back();
        }
    }

    public function available_appointment_list($id)
    {
       $book_slot = \App\Models\Booking_add_cart_time_order::leftjoin('booked_services','booking_add_cart_time_order.booking_id','booked_services.id')
                                                         ->leftjoin('slot_timing','booking_add_cart_time_order.slot_id','slot_timing.id')
                                                            ->where('booking_add_cart_time_order.slot_id',$id)
                                                            //->whereDate('booking_add_cart_time_order.date', \Carbon\Carbon::today())
                                                           ->select('booking_add_cart_time_order.*','slot_timing.slot_time')
                                                            ->get();

       return view('business.available_appointment_list',compact('book_slot'));

    }
    public function book_appointment($id,$date = '')
    {
        
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 

            $get_slot = \App\Models\Slot_timing::where('id',$id)->first();
       // $get_slot = \App\Models\Slot_timing::where('business_id',$business_id->id)->pluck('slot_time','id');

        $services = \App\Models\Services_product::where('created_by',$business_id->id)->pluck('name','id');


        return view('business.book_appointments',compact('get_slot','services','date'));   
    }

    

    public function save_appointment(Request $request)
    {
        $input = $request->all();
        
        $user_details = \App\User::where('unique_no',$request->user_id)->first();
        
        if(empty($user_details))
        {
            Flash::error("User Not Found");
            return back();    
        }
        $last_order =  Booked_services::where('created_by',$request->created_by)->orderBy('id','DESC')->select('booking_id')->first();
        if(!empty($last_order)){
            $input['booking_id'] = $last_order->booking_id + 1;
        }else{

            $input['booking_id'] =  1;
        }
        $input['booking_service_date_time'] = $request->start_date;
        $input['member_id'] = $user_details->id;
        $input['member_name'] = $user_details->name;
        $input['service_name'] = implode(',', $input['product_id']);

        $bookedServices = $this->bookedServicesRepository->create($input);
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
                        'user_id'      => $user_details->id,
                       ]);
                //$value['order_id'] = $order_id->id;
                $orde_extra_add = \App\Models\Order_cart_extra_details::create($requestData);
            }
            
            $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
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
                            ]);
                    $orde_extra_add = \App\Models\Booking_add_cart_time_order::create($requestData);
            //}

            for ($i=0; $i<count($request->product_id); $i++) {           
            $input_data_details['product_id'] = $request->product_id[$i];
            //$input_data_details['product_name_extra'] = $request->product_name_extra[$i];
            $input_data_details['booking_id'] = $booking_id->id;
            $input_data_details['type'] = 2;
            $input_data_details['booking_date'] = $request->start_date;
            //$input_data_details['product_time_array'] = $request->product_time_array[$i];
            $extra = \App\Models\Booked_services_details::create($input_data_details);
                
            }


            $data = Date('Y-m-d : h:s:i');
            $cart = \App\Models\Add_cart::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
            $cart_extra = \App\Models\Cart_extra_details::where('user_id', $request->user_id)->whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
             $Booking_addcart_product = \App\Models\Booking_addcart_product::whereIn('product_id',$request->product_id)->update(['deleted_at' => $data]);
            //return response(['status'=>'200','Message'=>'Booking added successfully.','bookedServices' => $bookedServices]);

        }
        Flash::success('Appointment Created successfully');
        return redirect(url('appointments_view'));
        //return view('business.findMember');
        //return $this->sendResponse(new Booked_servicesResource($bookedServices), 'Booked Services saved successfully');
    }
    public function appointment_by_date($date)
    {
        $buss_id = \App\User::where('id',Auth::user()->id)->first();
        
        $business_id  = \App\User::where('userDetailsId',$buss_id->business_id)->where('role_id','3')->where('user_type','3')->first(); 
        //$all_slot = \App\Models\Booking_add_cart_time::where('business_id',$business_id->id)->get(); 

        $book_slot = \App\Models\Slot_timing::where('slot_timing.business_id',$business_id->id)
                                                //->whereDate('booking_add_cart_time_order.date', Carbon::today())
                                                ->leftjoin('booking_add_cart_time_order','slot_timing.id','booking_add_cart_time_order.slot_id')
                                                ->select('slot_timing.*',DB::raw('COUNT(booking_add_cart_time_order.slot_id) as total_booking'))
                                                ->groupBy('slot_timing.id')
                                                ->get();         
        return view('business.appointment_by_date',compact('book_slot','date'));
    }
    public function findMember()
    {        
        return view('business.findMember');
    }
    public function findMemberDetails(Request $request)
    {
        $userDetails = \App\User::where('unique_no',$request->user_id)->first();
        if(!empty($userDetails))
        {
            return view('business.voucherDetails',compact('userDetails'));
        }
        else
        {
            Flash::error('Member does not exist');
            return redirect(route('findMember'));
        }
    }
    public function rewards_details($id)
    {

        if(Auth::user()->role_id == 3)
        {
            $business_details = Brand::where('id',Auth::user()->userDetailsId)->first();    
            $business_stamp = \App\Models\Stamp_master::where('business_id',Auth::user()->userDetailsId)->first();
            $business_point = \App\Models\Points_master::where('business_id',Auth::user()->userDetailsId)->first();

            $points_segment = \App\Models\Points_segment::where('point_id',$business_point->id)->first();
            $flag_selection = \App\Models\Flag_selection::leftjoin('points_segment','flag_selection.segment_id','points_segment.id')
                                                        //->where('flag_selection.segment_id',$points_segment->id)
                                                        // ->where('flag_selection.buss_id',$business_details->id)
                                                        ->where('flag_selection.user_id',$id)
                                                         ->select('points_segment.amount')
                                                        ->first();
            
        }
        else
        {

            $buss_id_d = User::where('id',Auth::user()->business_id)->where('role_id','3')->first();
            //echo $buss_id_d->userDetailsId; exit;
            $buss_id = User::where('id',Auth::user()->created_by)->first();

            $business_details = Brand::where('id', $buss_id_d->userDetailsId)->first(); 

            $business_stamp = \App\Models\Stamp_master::where('business_id',$buss_id_d->userDetailsId)->first();
            $business_point = \App\Models\Points_master::where('business_id',$buss_id_d->userDetailsId)->first();
            $total_stmp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',@$buss_id_d->userDetailsId)
                                                       ->where('user_id',@$id)
                                                        ->select('total_stamp','total_point')
                                                        ->first();;
            /*echo "<pre>";
    print_r( $total_stmp_point); exit;*/

        //echo "<pre>"; print_r($business_point); exit;
            if(!empty($business_point))
            {

                $points_segment = \App\Models\Points_segment::where('point_id',$business_point->id)->first();
                $flag_selection1 = \App\Models\Flag_selection::where('segment_id',$points_segment->segments_id)
                                                            //->select('points_segment.amount')
                                                            ->first();
                $flag_selection = \App\Models\Points_segment::where('segments_id',@$flag_selection1->segment_id)
                                                            ->select('segments_id','amount')
                                                            ->first();    
            }
            else
            {

                $flag_selection = '';
            }
            
            //echo Auth::user()->created_by;
            /*echo "<pre>";
            print_r($flag_selection); exit;*/
        }
        
    
        $user_stmp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',Auth::user()->business_id)
                                                                ->where('user_id',$id)
                                                                ->select('bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point')
                                                                ->first();
            /*echo "<pre>";
            print_r($user_stmp_point); exit;  */  

        $user_details = User::where('id',$id)->first();
        $user_wallet = User_voucher::where('user_id',$id)->first();

        return view('business.rewards',compact('business_details','user_details','business_stamp','business_point','user_wallet','flag_selection','user_stmp_point','total_stmp_point'));
    }
    public function rewards_submit(Request $request)
    {
        //echo Auth::user()->business_id; exit;

        if($request->stamp_point == 1)
        {

            
            $oldPoint = User::where('id',$request->user_id)->first();
            
            $input['point'] = $request->points + $oldPoint->point;
            $buss_id_cu = User::where('id',Auth::user()->business_id)->first();
            /*echo "<pre>";
            print_r($buss_id_cu['userDetailsId']); exit;*/

            $business_stamp = \App\Models\Stamp_master::where('business_id',$buss_id_cu['userDetailsId'])->first();

            $old_stamp = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id_cu['userDetailsId'])->where('user_id',$request->user_id)->first();
            /*echo "<pre>";
            print_r($old_stamp->total_stamp); exit;*/
            if(!empty($old_stamp->total_stamp) && $old_stamp->total_stamp < $business_stamp->setup_level)
            {
                $input['stamp'] = $request->stamp + $oldPoint->total_stamp;                
               
            }else{
                $input['stamp'] = 1;
            }
            $input['transaction_type'] = $request->transaction_type;
            $input['business_id'] = Auth::user()->business_id;

            $input1['user_id'] = $request->user_id;
            $input1['buss_id'] = $buss_id_cu['userDetailsId'];
            $input1['transaction_type_id'] = $request->transaction_type;
            $input1['old_point'] = $oldPoint->point;
            $input1['current_point'] = $request->points + $oldPoint->point;
            $input1['type'] = '1';
            $transaction_history = \App\Models\Transaction_history::create($input1);

            $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id_cu['userDetailsId'])->where('user_id',$request->user_id)->first();


            if(empty($bussiness_wise_stamp_point))
            { 
                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $buss_id_cu['userDetailsId'];
                $total_data['total_stamp'] = $input['stamp'];
                $total_data['total_point'] = $request->points;
                $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
            }else{

                //echo Auth::user()->id; exit;
                 $old_stamp = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id_cu['userDetailsId'])
                        ->where('user_id',$request->user_id)->first();

                if(!empty($old_stamp->total_stamp) && $old_stamp->total_stamp < $business_stamp->setup_level)
                {
                    $stamp_d= $old_stamp->total_stamp;                
                   
                }else{
                    $stamp_d = 1;
                }
                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $buss_id_cu['userDetailsId'];
                $total_data['total_stamp'] = $request->stamp + $stamp_d ;
                $total_data['total_point'] = $request->points + $bussiness_wise_stamp_point->total_point ;

              /* echo "<pre>";
               print_r($request->user_id); exit;*/
                $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id_cu['userDetailsId'])->where('user_id',$request->user_id)->update($total_data);

            }

            $nfc_codes = \App\Models\Nfc_code::where('stamp_id',$business_stamp->id)->first();

            $my_rewards['user_id'] = $request->user_id;
            $my_rewards['nfc_code'] = $nfc_codes->nfc_code;
            $my_rewards['buss_id'] = $buss_id_cu['userDetailsId'];
            $my_rewards['stamps'] = $request->stamp;
            $my_rewards['setup_level'] = $business_stamp->setup_level;
            $my_rewards['point_per_stamp'] = $business_stamp->point_per_stamp;
            $my_rewards['setup_level_count'] = $request->stamp;

            $insert_reward = \App\Models\My_rewards::create($my_rewards);

            $update = User::where('id',$request->user_id)->update($input);

            Flash::success('Stamps and Points credited successfully in your rewards.');
            return redirect(route('findMember'));
            //$category = $this->categoryRepository->update($input, $id);
        }
        else
        {
            //echo "string"; exit;
    
            $buss_id_cu = User::where('id',Auth::user()->business_id)->first();
            $oldPoint = User::where('id',$request->user_id)->first();

            $input['point'] = $request->points + $oldPoint->point;
            $input['transaction_type'] = $request->transaction_type;
            $input['business_id'] =$buss_id_cu['userDetailsId'];

            $input1['user_id'] = $request->user_id;
            $input1['buss_id'] =$buss_id_cu['userDetailsId'];
            $input1['transaction_type_id'] = $request->transaction_type;
            $input1['old_point'] = $oldPoint->point;
            $input1['current_point'] = $request->points + $oldPoint->point;
            $input1['type'] = '1';

            $transaction_history = \App\Models\Transaction_history::create($input1);


            $user_buss_id = \App\User::where('id',Auth::user()->business_id)->first();
          /*  echo "<pre>";
            print_r($user_buss_id->userDetailsId); exit;*/

            $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id_cu['userDetailsId'])
                                                                                ->where('user_id',$request->user_id)
                                                                                ->first();
            if(empty($bussiness_wise_stamp_point))
            { 
                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $buss_id_cu['userDetailsId'];
                $total_data['total_point'] = $request->points;
                $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
                
                                
            }else{

                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = $buss_id_cu['userDetailsId'];
                $total_data['total_point'] = $request->points + $bussiness_wise_stamp_point->total_point;
                $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id_cu['userDetailsId'])
                                                                                ->where('user_id',$request->user_id)->update($total_data);

            }

            $update = User::where('id',$request->user_id)->update($input);
            Flash::success('Points credited successfully in your rewards.');
            return redirect(route('findMember'));

        }
        
    }
    public function get_member_voucher($id)
    {
        if(Auth::user()->role_id == 3)
        {

            $memberVoucher = User_voucher::where('user_id',$id)
            ->leftjoin('voucher','user_wallet.voucher_id','voucher.id')
            ->where('voucher.business_id',Auth::user()->userDetailsId)
            ->where('user_wallet.used_code_status',0)
            ->select('voucher.*')
            ->get();
        }
        else
        {
            $buss_id = User::where('id',Auth::user()->created_by)->first();

            $memberVoucher = User_voucher::where('user_id',$id)
            ->leftjoin('voucher','user_wallet.voucher_id','voucher.id')
            ->where('voucher.business_id',Auth::user()->created_by)
            ->where('user_wallet.used_code_status',0)
            ->select('voucher.*')
            ->get();


        }


        $user_details = User::where('id',$id)->first();
        return view('business.free_voucher',compact('memberVoucher','user_details'));
    }
    public function credit_member_voucher(Request $request)
    {
        $input['used_code_status'] = 1;
        
        $update = User_voucher::where('user_id',$request->user_id)->where('voucher_id',$request->voucher_id)->update($input);

        Flash::success('Member voucher has been used and debited from your wallet.');

        return redirect(route('findMember'));
    }
    public function get_give_voucher($id)
    {
        if(Auth::user()->role_id == 3)
        {
            $vouchers = \App\Models\Voucher::where('business_id',Auth::user()->userDetailsId)->where('category_id','1')->where('code_status',0)->get();
        }
        else
        {
            $buss_id = User::where('id',Auth::user()->created_by)->first();
            $vouchers = \App\Models\Voucher::where('business_id',Auth::user()->created_by)->where('category_id','1')->where('code_status',0)->get();
        }
        $user_details = User::where('id',$id)->first();
        return view('business.give_voucher',compact('vouchers','user_details'));
    }
    public function post_give_voucher(Request $request)
    {

        $voucher_details = \App\Models\Voucher::where('id',$request['voucher_id'])->where('code',$request['voucher_code'])->first();
        
        
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
                                $input['used_code_status'] = 0;
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

                                Flash::success("Voucher has been credited successfully in your wallet.");
                                return redirect(route('findMember'));
                                
                            }
                            else
                            {
                                
                                Flash::error("Voucher is already used");
                                return redirect(route('findMember'));
                            }
                        }    
                        else
                        {
                            Flash::error("Voucher Expired");
                            return redirect(route('findMember'));
                        }
                    }
                    else
                    {
                        Flash::error("Voucher Doesn't Start Yet");
                        return redirect(route('findMember'));
                    }
                }
                else
                {            
                    Flash::error("the code doesn't exist");
                    return redirect(route('findMember'));
                }
            
        }
        else
        {
            Flash::error('Voucher Does not exist');

            return redirect(route('findMember'));
        }
    }
    public function cash_back($id)
    {
        $user_details = User::where('id',$id)->first();
        if(Auth::user()->role_id == 3)
        {
            $business_point = \App\Models\Points_master::where('business_id',Auth::user()->userDetailsId)->first();
        }
        else
        {

            $buss_id = User::where('id',Auth::user()->created_by)->first();
            $business_point = \App\Models\Points_master::where('business_id',Auth::user()->created_by)->first();
            if(empty($business_point)){
              $business_point = \App\Models\Stamp_master::where('business_id',Auth::user()->created_by)->first();  
            }
            $user_stmp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',Auth::user()->business_id)
                                                                ->where('user_id',$id)
                                                                ->select('bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point')
                                                                ->first();

            /*echo "<pre>";
            print_r($user_stmp_point); exit;*/
          
        }

        return view('business.cash_back',compact('user_details','business_point','user_stmp_point'));
    }
    public function save_cash_back(request $request)
    {
        
        $oldPoint = User::where('id',$request->user_id)->first();
        
        $input['point'] = $oldPoint->point - $request->cash_out_points;
        $input['transaction_type'] = $request->transaction_type;
        $input['business_id'] = Auth::user()->business_id;


        $input1['user_id'] = $request->user_id;
        $input1['buss_id'] = Auth::user()->business_id;
        $input1['transaction_type_id'] = $request->transaction_type;
        $input1['old_point'] = $oldPoint->point;
        $input1['current_point'] = $oldPoint->point - $request->cash_out_points;
        $input1['cash_out_points'] = $request->cash_out_points;;
        $input1['type'] = '1';

        $transaction_history = \App\Models\Transaction_history::create($input1);

         $bussiness_wise_stamp_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',Auth::user()->business_id)->first();
            if(empty($bussiness_wise_stamp_point))
            { 
                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = Auth::user()->business_id;
                $total_data['total_point'] = $bussiness_wise_stamp_point->total_point - $request->cash_out_points;
                $add_data = \App\Models\Bussiness_wise_stamp_point::create($total_data);
            }else{

                $total_data['user_id'] = $request->user_id;
                $total_data['business_id'] = Auth::user()->business_id;
                $total_data['total_point'] = $bussiness_wise_stamp_point->total_point - $request->cash_out_points ;
                $update_data = \App\Models\Bussiness_wise_stamp_point::where('business_id',Auth::user()->business_id)->update($total_data);

            }

        $update = User::where('id',$request->user_id)->update($input);
        Flash::success('Point Updated Sucessfully');
        return redirect(route('findMember'));
        
    }
    public function invite_member()
    {
        return view('business.invite_member');
    }
    public function sendInvitation(Request $request)
    {
        $user = \App\User::where('email',$request->email)->first();

        if(!empty($user))
        {
            Flash::error("User Already Registered");
            return redirect(route('invite_member'));
        }
        
        if(Auth::user()->role_id == 3)
        {   
            $businessDetails = Brand::where('id',Auth::user()->userDetailsId)->first();
            $data['email'] = $request->email;
            $data['business_name'] = $businessDetails->name;
            
            $response = Email_master::send_invitation($data);
        }
        else
        {
            $buss_id = User::where('id',Auth::user()->created_by)->first();
            $businessDetails = Brand::where('id',Auth::user()->created_by)->first();   
        
            $data['email'] = $request->email;
            $data['business_name'] = $businessDetails->name;
            
            $response = Email_master::send_invitation($data);
        }

        Flash::success("Invitation Send Sucessfully");
        return redirect(route('invite_member'));
    }
    public function offerBannersList()
    {
        if(Auth::user()->role_id == 3)
        {
            $offers = \App\Models\Offer_banner::where('user_id',Auth::user()->id)->get();
        }
        else
        {
            $buss_id = User::where('created_by',Auth::user()->created_by)->first();
            $buss_id_data = User::where('userDetailsId',$buss_id->created_by)->where('role_id','3')->first();
          
            $offers = \App\Models\Offer_banner::where('user_id',$buss_id_data->id)->get();
        }
        return view('business.offer_banner',compact('offers'));

    }
    /**
     * Display a listing of the Voucher_upload_receipt.
     *
     * @param Voucher_upload_receiptDataTable $voucherUploadReceiptDataTable
     * @return Response
     */
    public function index(Voucher_upload_receiptDataTable $voucherUploadReceiptDataTable)
    {
        //return $voucherUploadReceiptDataTable->render('voucher_upload_receipts.index');
        /* $data = \App\Models\Voucher_upload_receipt::
        leftjoin('brand','voucher_upload_receipt.business_id','brand.id')
        ->leftjoin('users','voucher_upload_receipt.user_id','users.id')
        ->leftjoin('voucher','voucher_upload_receipt.voucher_id','voucher.id')
        ->select('voucher_upload_receipt.*','brand.name as bussName','users.name as uname','voucher.code as voucherCode')
        ->orderBy('id','DESC')->get();
        return view('voucher_upload_receipts.index',compact('data')); */
    }

    /**
     * Show the form for creating a new Voucher_upload_receipt.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher_upload_receipts.create');
    }

    /**
     * Store a newly created Voucher_upload_receipt in storage.
     *
     * @param CreateVoucher_upload_receiptRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucher_upload_receiptRequest $request)
    {
        $input = $request->all();

        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->create($input);

        Flash::success('Voucher Upload Receipt saved successfully.');

        return redirect(route('voucherUploadReceipts.index'));
    }

    /**
     * Display the specified Voucher_upload_receipt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        return view('voucher_upload_receipts.show')->with('voucherUploadReceipt', $voucherUploadReceipt);
    }

    /**
     * Show the form for editing the specified Voucher_upload_receipt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        return view('voucher_upload_receipts.edit')->with('voucherUploadReceipt', $voucherUploadReceipt);
    }

    /**
     * Update the specified Voucher_upload_receipt in storage.
     *
     * @param  int              $id
     * @param UpdateVoucher_upload_receiptRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucher_upload_receiptRequest $request)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->update($request->all(), $id);

        Flash::success('Voucher Upload Receipt updated successfully.');

        return redirect(route('voucherUploadReceipts.index'));
    }

    /**
     * Remove the specified Voucher_upload_receipt from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        $this->voucherUploadReceiptRepository->delete($id);

        Flash::success('Voucher Upload Receipt deleted successfully.');

        return redirect(route('voucherUploadReceipts.index'));
    }
}
