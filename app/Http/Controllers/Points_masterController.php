<?php

namespace App\Http\Controllers;

use App\DataTables\Points_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePoints_masterRequest;
use App\Http\Requests\UpdatePoints_masterRequest;
use App\Repositories\Points_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Validator;

class Points_masterController extends AppBaseController
{
    /** @var  Points_masterRepository */
    private $pointsMasterRepository;

    public function __construct(Points_masterRepository $pointsMasterRepo)
    {
        $this->pointsMasterRepository = $pointsMasterRepo;

        $this->middleware('permission:points_masters-index|points_masters-create|points_masters-edit|points_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:points_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:points_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:points_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Points_master.
     *
     * @param Points_masterDataTable $pointsMasterDataTable
     * @return Response
     */
    public function index(Points_masterDataTable $pointsMasterDataTable)
    {
       // return $pointsMasterDataTable->render('points_masters.index');
        $data = \App\Models\Points_master::leftjoin('brand','points_master.business_id','brand.id')
            ->leftjoin('country','points_master.country_id','country.id')
            ->leftjoin('currency','points_master.currency_id','currency.id')
            ->leftjoin('segment','points_master.segments_id','segment.id')
            ->select('points_master.*','brand.name as bussName','country.country_name as countryName','currency.currency_name','segment.segment_name')
            ->orderBy('points_master.id','DESC')->get();
        return view('points_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Points_master.
     *
     * @return Response
     */
    public function create()
    {
        $brands = \App\Models\Brand::where('stamp_point','2')->where('status','1')->pluck('name','id');
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $currency_data = \DB::table('currency')->pluck('currency_code','id');
        $segment_data = \App\Models\Segment::where('status','1')->pluck('segment_name','id');
        $user_data = \App\User::where('role_id','4')->pluck('name','id');
        return view('points_masters.create',compact('brands','country_data','currency_data','segment_data','user_data'));
        
    }

    /**
     * Store a newly created Points_master in storage.
     *
     * @param CreatePoints_masterRequest $request
     *
     * @return Response
     */
    public function store(CreatePoints_masterRequest $request)
    {

        $input = $request->all();
        $chec_id = \App\Models\Points_master::select('id')->where('business_id',$request->business_id)->exists();

       if(empty($chec_id) && $chec_id != 1)
       {
            if(isset($request->c_segments_id))
            {
                 $input['c_segments_id'] = implode(',', $request->c_segments_id);

            }
            if(isset($request->birth_segments_id))
            {
                 $input['birth_segments_id'] = implode(',', $request->birth_segments_id);

            }
            if(isset($request->welcome_segments_id))
            {
                 $input['welcome_segments_id'] = implode(',', $request->welcome_segments_id);

            }
            if($request->hasfile('image_of_loyalty_card'))
                {

                    $image = $request->file('image_of_loyalty_card');
                    $extension = $image->getClientOriginalExtension(); // getting image extension
                    $filename ='public/media/point/image_of_loyalty_card/'.$image->getClientOriginalName();
                    $path = public_path('/media/point/image_of_loyalty_card/');
                    $image->move($path, $filename);
                    $input['image_of_loyalty_card'] = $filename;
                }else
                {
                    $input['image_of_loyalty_card'] = '';
                }

            $pointsMaster = $this->pointsMasterRepository->create($input);

            for ($i=0; $i<count($request->segments_id); $i++) {
                    $segments_data = new \App\Models\Points_segment;
                    $latest = \App\Models\Points_master::orderBy('id','DESC')->select('id')->first();
                    $segments_data->point_id = $latest->id;
                    $segments_data->segments_id = $request->segments_id[$i];
                    $segments_data->segments_based_on_scenarios = $request->segments_based_on_scenarios[$i];
                    //$segments_data->buss_id = $request->business_id[$i];
                    $segments_data->amount = $request->amount[$i];    
                    $segments_data->save();
                
            }

            Flash::success('Points Master saved successfully.');
            return redirect(route('pointsMasters.index'));
        }else{
            Flash::error('The business has already been taken..');
            return redirect(route('pointsMasters.index'));
        }
    }

    /**
     * Display the specified Points_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pointsMaster = $this->pointsMasterRepository->find($id);

        if (empty($pointsMaster)) {
            Flash::error('Points Master not found');

            return redirect(route('pointsMasters.index'));
        }

        return view('points_masters.show')->with('pointsMaster', $pointsMaster);
    }

    /**
     * Show the form for editing the specified Points_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pointsMaster = $this->pointsMasterRepository->find($id);
         $brands = \App\Models\Brand::where('stamp_point','2')->where('status','1')->pluck('name','id');
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $currency_data = \DB::table('currency')->pluck('currency_code','id');
        $segment_data = \App\Models\Segment::where('status','1')->pluck('segment_name','id');



        if (empty($pointsMaster)) {
            Flash::error('Points Master not found');

            return redirect(route('pointsMasters.index'));
        }

        return view('points_masters.edit',compact('brands','country_data','currency_data','segment_data'))->with('pointsMaster', $pointsMaster);
    }

    /**
     * Update the specified Points_master in storage.
     *
     * @param  int              $id
     * @param UpdatePoints_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePoints_masterRequest $request)
    {
        $pointsMaster = $this->pointsMasterRepository->find($id);

        if (empty($pointsMaster)) {
            Flash::error('Points Master not found');

            return redirect(route('pointsMasters.index'));
        }
        $input = $request->all();
        if(isset($request->c_segments_id))
        {
             $input['c_segments_id'] = implode(',', $request->c_segments_id);

        }
        if(isset($request->birth_segments_id))
        {
             $input['birth_segments_id'] = implode(',', $request->birth_segments_id);

        }
        if(isset($request->welcome_segments_id))
        {
             $input['welcome_segments_id'] = implode(',', $request->welcome_segments_id);

        }
        if($request->hasfile('image_of_loyalty_card'))
        {

            $image = $request->file('image_of_loyalty_card');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/point/image_of_loyalty_card/'.$image->getClientOriginalName();
            $path = public_path('/media/point/image_of_loyalty_card/');
            $image->move($path, $filename);
            $input['image_of_loyalty_card'] = $filename;
        }else
        {
            $input['image_of_loyalty_card'] = $pointsMaster['image_of_loyalty_card'];
        }
        $pointsMaster = $this->pointsMasterRepository->update($input, $id);
        $data = Date('Y-m-d : h:s:i');
        $question_details = \App\Models\Points_segment::where('point_id', $id)->update(['deleted_at' => $data]);

        for ($i=0; $i<count($request->segments_id); $i++) {
                $delete = \App\Models\Points_master::orderBy('id','DESC')->select('id')->first();
                $segments_data = new \App\Models\Points_segment;
                $segments_data->point_id = $id;
                $segments_data->segments_id = $request->segments_id[$i];
                $segments_data->segments_based_on_scenarios = $request->segments_based_on_scenarios[$i];
               // $segments_data->buss_id = $request->business_id[$i];
                $segments_data->amount = $request->amount[$i];    
                $segments_data->save();
            
        }

        Flash::success('Points Master updated successfully.');

        return redirect(route('pointsMasters.index'));
    }

    /**
     * Remove the specified Points_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pointsMaster = $this->pointsMasterRepository->find($id);

        if (empty($pointsMaster)) {
            Flash::error('Points Master not found');

            return redirect(route('pointsMasters.index'));
        }

        $this->pointsMasterRepository->delete($id);

        Flash::success('Points Master deleted successfully.');

        return redirect(route('pointsMasters.index'));
    }
}
