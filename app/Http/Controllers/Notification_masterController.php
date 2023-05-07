<?php

namespace App\Http\Controllers;

use App\DataTables\Notification_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNotification_masterRequest;
use App\Http\Requests\UpdateNotification_masterRequest;
use App\Repositories\Notification_masterRepository;
use App\Repositories\Notification_detailsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Notification_masterController extends AppBaseController
{
    /** @var  Notification_masterRepository */
    private $notificationMasterRepository;

    public function __construct(Notification_masterRepository $notificationMasterRepo)
    {
        $this->notificationMasterRepository = $notificationMasterRepo;

        $this->middleware('permission:notification_masters-index|notification_masters-create|notification_masters-edit|notification_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:notification_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:notification_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:notification_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Notification_master.
     *
     * @param Notification_masterDataTable $notificationMasterDataTable
     * @return Response
     */
    public function index(Notification_masterDataTable $notificationMasterDataTable)
    {
        //return $notificationMasterDataTable->render('notification_masters.index');
        $data = \App\Models\Notification_master::orderBy('id','DESC')->get();
        return view('notification_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Notification_master.
     *
     * @return Response
     */
    public function create()
    {
        $user = \App\User::where('role_id','4')->pluck('name','id');
        return view('notification_masters.create',compact('user'));
    }

    /**
     * Store a newly created Notification_master in storage.
     *
     * @param CreateNotification_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateNotification_masterRequest $request)
    {
        $input = $request->all();
       /* echo "<pre>";
        print_r($input); exit;*/
        if($request->hasfile('notification_image'))
        {

            $image = $request->file('notification_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/notification_image/'.$image->getClientOriginalName();
            $path = public_path('/media/notification_image/');
            $image->move($path, $filename);
            $input['notification_image'] = $filename;
        }else
        {
            $input['notification_image'] = '';
        }
        $input['status'] = '1'; 
        $input['user_id'] = implode(',', $input['user_id']); 
         
        $notificationMaster = $this->notificationMasterRepository->create($input);

        Flash::success('Notification Master saved successfully.');

        return redirect(route('notificationMasters.index'));
    }

    /**
     * Display the specified Notification_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            Flash::error('Notification Master not found');

            return redirect(route('notificationMasters.index'));
        }

        return view('notification_masters.show')->with('notificationMaster', $notificationMaster);
    }

    /**
     * Show the form for editing the specified Notification_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            Flash::error('Notification Master not found');

            return redirect(route('notificationMasters.index'));
        }
        $user = \App\User::where('role_id','4')->pluck('name','id');

        return view('notification_masters.edit',compact('user'))->with('notificationMaster', $notificationMaster);
    }

    /**
     * Update the specified Notification_master in storage.
     *
     * @param  int              $id
     * @param UpdateNotification_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotification_masterRequest $request)
    {
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            Flash::error('Notification Master not found');

            return redirect(route('notificationMasters.index'));
        }

        $input = $request->all();
        if($request->hasfile('notification_image'))
        {

            $image = $request->file('notification_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/notification_image/'.$image->getClientOriginalName();
            $path = public_path('/media/notification_image/');
            $image->move($path, $filename);
            $input['notification_image'] = $filename;
        }else
        {
            $input['notification_image'] = $notificationMaster['notification_image'];
        }
        $input['user_id'] = implode(',', $input['user_id']); 
        $notificationMaster = $this->notificationMasterRepository->update($input, $id);

        Flash::success('Notification Master updated successfully.');

        return redirect(route('notificationMasters.index'));
    }

    /**
     * Remove the specified Notification_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            Flash::error('Notification Master not found');

            return redirect(route('notificationMasters.index'));
        }



        $this->notificationMasterRepository->delete($id);

        $data = Date('Y-m-d : h:s:i');

        $question_details = \App\Models\Notification_details::where('notification_id', $id)->update(['deleted_at' => $data]);
        Flash::success('Notification Master deleted successfully.');

        return redirect(route('notificationMasters.index'));
    }
    public function notification_status($id, $status)
    {

        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            Flash::error('Notification not found');

            return redirect(route('languages.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $notificationMaster = $this->notificationMasterRepository->update($data, $id);

        Flash::success('Notification status updated successfully.');

        return redirect(route('notificationMasters.index'));
    }
    public function sendNotification($id)
    {
        $notificationMaster = $this->notificationMasterRepository->find($id);
       

        $firebaseToken = \App\User::where('users.role_id',4)->whereIn('users.id',explode(',', $notificationMaster['user_id']))->whereNotNull('device_token')->pluck('device_token')->all();
        
        $user_data = \App\User::where('users.role_id',4)->whereIn('users.id',explode(',', $notificationMaster['user_id']))->whereNotNull('device_token')->select('id')->get();

        $input['send_status'] = 1;
        $notificationUpdate = $this->notificationMasterRepository->update($input, $id);
    
        
        $notification_details = $this->notificationMasterRepository->find($id);
        $imgData = url('/').'/'.$notification_details->notification_image; 

        //$userArray = [];
        foreach ($user_data as  $value) {
            $userArray = array("notification_id" => $id,"user_id" => $value['id']);
            $notificationDetails = \App\Models\Notification_details::create($userArray);
        }

        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "type" => "Notification",
                "title" => $notification_details->title,
            ], 
            "data" => [
                "type" => "Notification",
                "id" => $id,
                "title" => $notification_details->title,
                "details" =>$notification_details->details,
                "image" => $notification_details->notification_image,
                "date" => $notification_details->created_at,
            ]         

        ];
      
        $dataString = json_encode($data);  

/*        echo "<pre>";
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
        
        Flash::success('Notification Send successfully.');
        return redirect(route('notificationMasters.index'));   
    }
}
