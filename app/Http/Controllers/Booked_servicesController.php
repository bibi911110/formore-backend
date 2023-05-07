<?php

namespace App\Http\Controllers;

use App\DataTables\Booked_servicesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBooked_servicesRequest;
use App\Http\Requests\UpdateBooked_servicesRequest;
use App\Repositories\Booked_servicesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Booked_servicesController extends AppBaseController
{
    /** @var  Booked_servicesRepository */
    private $bookedServicesRepository;

    public function __construct(Booked_servicesRepository $bookedServicesRepo)
    {
        $this->bookedServicesRepository = $bookedServicesRepo;

        $this->middleware('permission:booked_services-index|booked_services-create|booked_services-edit|booked_services-delete', ['only' => ['index','store']]);
        $this->middleware('permission:booked_services-create', ['only' => ['create','store']]);
        $this->middleware('permission:booked_services-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:booked_services-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Booked_services.
     *
     * @param Booked_servicesDataTable $bookedServicesDataTable
     * @return Response
     */
    public function index(Booked_servicesDataTable $bookedServicesDataTable)
    {
        // return $bookedServicesDataTable->render('booked_services.index');
         $data = \App\Models\Booked_services::orderBy('booking_id','DESC')->where('booked_services.created_by',Auth::user()->id)->get();

         $notification = \App\Models\Notification_all_count::where('business_id',Auth::user()->id)
                    ->where('slug','appointment')
                    ->where('status',0)
                    ->get();            
            if(!empty($notification))
            {
                foreach ($notification as $value) {
                    $update['status'] = 1;
                    \App\Models\Notification_all_count::where('id',$value['id'])->update($update);

                }
                
            }
            
        /*foreach ($data as  $value) {
            if(Auth::user()->role_id == '5') 
            { 
                $updateStatus['view_buss_user_notification_status'] = 1
                \App\Models\Booked_services::where('id',$value['id'])->update($updateStatus);
            } 
            if(Auth::user()->role_id == '3') 
            { 
                $updateStatus['view_notification_status'] = 1
                \App\Models\Booked_services::where('id',$value['id'])->update($updateStatus);
            } 
        }
        exit;*/
        return view('booked_services.index',compact('data'));
    }

    /**
     * Show the form for creating a new Booked_services.
     *
     * @return Response
     */
    public function create()
    {
        return view('booked_services.create');
    }

    /**
     * Store a newly created Booked_services in storage.
     *
     * @param CreateBooked_servicesRequest $request
     *
     * @return Response
     */
    public function store(CreateBooked_servicesRequest $request)
    {
        $input = $request->all();

        $bookedServices = $this->bookedServicesRepository->create($input);

        Flash::success('Booked Services saved successfully.');

        return redirect(route('bookedServices.index'));
    }

    /**
     * Display the specified Booked_services.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bookedServices = $this->bookedServicesRepository->find($id);

        if (empty($bookedServices)) {
            Flash::error('Booked Services not found');

            return redirect(route('bookedServices.index'));
        }

        return view('booked_services.show')->with('bookedServices', $bookedServices);
    }

    /**
     * Show the form for editing the specified Booked_services.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bookedServices = $this->bookedServicesRepository->find($id);

        if (empty($bookedServices)) {
            Flash::error('Booked Services not found');

            return redirect(route('bookedServices.index'));
        }

        return view('booked_services.edit')->with('bookedServices', $bookedServices);
    }

    /**
     * Update the specified Booked_services in storage.
     *
     * @param  int              $id
     * @param UpdateBooked_servicesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBooked_servicesRequest $request)
    {
        $bookedServices = $this->bookedServicesRepository->find($id);
       // echo "<pre>"; print_r($bookedServices->created_by); exit;

        if (empty($bookedServices)) {
            Flash::error('Booked Services not found');

            return redirect(route('bookedServices.index'));
        }
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
        $bookedServices = $this->bookedServicesRepository->update($request->all(), $id);

        Flash::success('Booked Services updated successfully.');

        return redirect(route('bookedServices.index'));
    }

    /**
     * Remove the specified Booked_services from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bookedServices = $this->bookedServicesRepository->find($id);

        if (empty($bookedServices)) {
            Flash::error('Booked Services not found');

            return redirect(route('bookedServices.index'));
        }

        $this->bookedServicesRepository->delete($id);

        Flash::success('Booked Services deleted successfully.');

        return redirect(route('bookedServices.index'));
    }
}
