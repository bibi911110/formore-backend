<?php

namespace App\Http\Controllers;

use App\DataTables\RatingDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Repositories\RatingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;
use App\Exports\RatingExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class RatingController extends AppBaseController
{
    /** @var  RatingRepository */
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepository = $ratingRepo;

        $this->middleware('permission:ratings-index|ratings-create|ratings-edit|ratings-delete', ['only' => ['index','store']]);
        $this->middleware('permission:ratings-create', ['only' => ['create','store']]);
        $this->middleware('permission:ratings-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ratings-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Rating.
     *
     * @param RatingDataTable $ratingDataTable
     * @return Response
     */
    public function index(RatingDataTable $ratingDataTable)
    {
        if(Auth::user()->role_id == 3)
        {

        $data = \App\Models\Rating::orderBy('id','DESC')->where('rating.buss_id',Auth::user()->id)
                                    ->leftjoin('users','rating.user_id','users.id')
                                    ->select('rating.*','users.name as userName','users.unique_no')
                                    ->get();
        }else{

        $data = \App\Models\Rating::orderBy('id','DESC')->leftjoin('users','rating.user_id','users.id')
                                    ->select('rating.*','users.name as userName','users.unique_no')
                                    ->get();
                                    
        }
        $buss = \App\Models\Brand::where('type','1')->where('status','1')->get();;

        
        return view('ratings.index',compact('data','buss'));
       // return $ratingDataTable->render('ratings.index');
    }

    public function ratings_filter(Request $request)
    {
        session()->forget('buss_id');

        $buss_id = \App\User::where('userDetailsId',$request->buss_id)
                            ->where('users.user_type',3)
                             ->where('users.role_id',3)
                            ->first();


        if($request->buss_id == 'all')
        {
            $data = \App\Models\Rating::orderBy('id','DESC')
                                        //->where('rating.buss_id',$buss_id->id)
                                        ->leftjoin('users','rating.user_id','users.id')
                                        ->select('rating.*','users.name as userName','users.unique_no')
                                        ->get();
            $bus_id = 'all';
            $this->ratings_export($bus_id);

        }else{
            $data = \App\Models\Rating::orderBy('id','DESC')
                                        ->where('rating.buss_id',$buss_id->id)
                                        ->leftjoin('users','rating.user_id','users.id')
                                        ->select('rating.*','users.name as userName','users.unique_no')
                                        ->get();
            $bus_id = $buss_id->id;
            Session::put('buss_id', $buss_id->id);
            $this->ratings_export($buss_id->id);
        }
        $buss = \App\Models\Brand::where('type','1')->where('status','1')->get();



        return view('ratings.index',compact('data','buss','bus_id'));
    }

    public function ratings_export($id = '',$check= '')
    {


        /*if(isset($id) && $id !='')
        {
            if(Auth::user()->role_id == 3)
            {

            $data = \App\Models\Rating::orderBy('id','DESC')
                                        ->where('rating.buss_id',Auth::user()->id)
                                         ->where('rating.buss_id',$id)
                                        ->leftjoin('users','rating.user_id','users.id')
                                        ->select('rating.*','users.name as userName','users.unique_no')
                                        ->get()->toArray();

            }else{

            $data = \App\Models\Rating::orderBy('id','DESC')->leftjoin('users','rating.user_id','users.id')
                                         ->where('rating.buss_id',$id)
                                        ->select('rating.*','users.name as userName','users.unique_no')
                                        ->get()->toArray();
                                        
            }

        }
        else
        {
            if(Auth::user()->role_id == 3)
            {

            $data = \App\Models\Rating::orderBy('id','DESC')->where('rating.buss_id',Auth::user()->id)
                                        ->leftjoin('users','rating.user_id','users.id')
                                        ->select('rating.*','users.name as userName','users.unique_no')
                                        ->get()->toArray();
            }else{

            $data = \App\Models\Rating::orderBy('id','DESC')->leftjoin('users','rating.user_id','users.id')
                                        ->select('rating.*','users.name as userName','users.unique_no')
                                        ->get()->toArray();
                                        
            }

        }*/
            
        $folder_path = '/rating_excel/';
        if (!File::exists(public_path()  . $folder_path)) {
            File::makeDirectory(public_path() .  $folder_path, 0777, true);
        }
        $uniqid = uniqid();
      /*  echo "<pre>";
        print_r($id); exit;*/

        Excel::store(new RatingExport($id), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start();
        $buss_id =Session::get('buss_id');
        /*if(isset($buss_id))
        {
            session()->forget('buss_id');
        }*/
        Flash::success('Rating Excel saved successfully.');
        return Excel::download(new RatingExport, $basename);
    }

    /**
     * Show the form for creating a new Rating.
     *
     * @return Response
     */
    public function create()
    {   
        $buss = \App\Models\Brand::where('type','1')->where('status','1')->pluck('name','id');
        $users = \App\User::where('role_id','4')->pluck('name','id');


        return view('ratings.create',compact('buss','users'));
    }

    /**
     * Store a newly created Rating in storage.
     *
     * @param CreateRatingRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingRequest $request)
    {

        $input = $request->all();
        $buss_id = \App\User::where('userDetailsId',$request->buss_id)

                            ->where('users.user_type',3)
                             ->where('users.role_id',3)
                            ->first();

        
        $firebaseToken = \App\User::where('users.role_id',4)->whereIn('id',$request->user_id)->whereNotNull('device_token')->pluck('device_token')->all();
       /* echo "<pre>";
        print_r($firebaseToken);
        exit;*/
        
        //where('id',14)

        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Rating",
                "body" => $buss_id->id,
                "buss_id" =>$buss_id->id,

            ], 
            "data" => [
                "buss_id" =>$buss_id->id,
                "type" => "Rating",
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

        
        /*echo "<pre>";
        print_r($data); exit;*/
       /* $err = curl_error($curl);
        curl_close($curl);*/
        // dd($response);
       // $rating = $this->ratingRepository->create($input);

        Flash::success('Rating saved successfully.');

        return redirect(route('ratings.index'));
    }

    /**
     * Display the specified Rating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            Flash::error('Rating not found');

            return redirect(route('ratings.index'));
        }

        return view('ratings.show')->with('rating', $rating);
    }

    /**
     * Show the form for editing the specified Rating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            Flash::error('Rating not found');

            return redirect(route('ratings.index'));
        }

        return view('ratings.edit')->with('rating', $rating);
    }

    /**
     * Update the specified Rating in storage.
     *
     * @param  int              $id
     * @param UpdateRatingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingRequest $request)
    {
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            Flash::error('Rating not found');

            return redirect(route('ratings.index'));
        }

        $rating = $this->ratingRepository->update($request->all(), $id);

        Flash::success('Rating updated successfully.');

        return redirect(route('ratings.index'));
    }

    /**
     * Remove the specified Rating from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            Flash::error('Rating not found');

            return redirect(route('ratings.index'));
        }

        $this->ratingRepository->delete($id);

        Flash::success('Rating deleted successfully.');

        return redirect(route('ratings.index'));
    }

       public function rating_status($id, $status)
    {

        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            Flash::error('Rating not found');

            return redirect(route('ratings.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $rating = $this->ratingRepository->update($data, $id);

        Flash::success('Rating status updated successfully.');

        return redirect(route('ratings.index'));
    }
}
