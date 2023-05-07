<?php

namespace App\Http\Controllers;

use App\DataTables\Stamp_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStamp_masterRequest;
use App\Http\Requests\UpdateStamp_masterRequest;
use App\Repositories\Stamp_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Validation\Rule;

class Stamp_masterController extends AppBaseController
{
    /** @var  Stamp_masterRepository */
    private $stampMasterRepository;

    public function __construct(Stamp_masterRepository $stampMasterRepo)
    {
        $this->stampMasterRepository = $stampMasterRepo;

        $this->middleware('permission:stamp_masters-index|stamp_masters-create|stamp_masters-edit|stamp_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:stamp_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:stamp_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:stamp_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Stamp_master.
     *
     * @param Stamp_masterDataTable $stampMasterDataTable
     * @return Response
     */
    public function index(Stamp_masterDataTable $stampMasterDataTable)
    {
        //$data = \App\Models\Stamp_master::orderBy('id','DESC')->get();

         $data = \App\Models\Stamp_master::leftjoin('brand','stamp_master.business_id','brand.id')
            ->leftjoin('country','stamp_master.country_id','country.id')
            ->select('stamp_master.*','brand.name as bussName','country.country_name as countryName')
            ->orderBy('stamp_master.id','DESC')->get();
        return view('stamp_masters.index',compact('data'));
        //return $stampMasterDataTable->render('stamp_masters.index');
    }

    /**
     * Show the form for creating a new Stamp_master.
     *
     * @return Response
     */
    public function create()
    {
        $brands = \App\Models\Brand::where('stamp_point','1')->where('status','1')->pluck('name','id');
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $currency_data = \DB::table('currency')->pluck('currency_code','id');
        $segment_data = \App\Models\Segment::where('status','1')->pluck('segment_name','id');
        return view('stamp_masters.create',compact('brands','country_data','currency_data','segment_data'));
    }

    /**
     * Store a newly created Stamp_master in storage.
     *
     * @param CreateStamp_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateStamp_masterRequest $request)
    {

        $request->validate([
               
                'nfc_code.*' => 'required|unique:nfc_code,nfc_code',
                
            ]);
       $input = $request->all();
       $chec_id = \App\Models\Stamp_master::select('id')->where('business_id',$request->business_id)->exists();

       if(empty($chec_id) && $chec_id != 1)
       {

             if($request->hasfile('image_of_loyalty_card'))
                {

                    $image = $request->file('image_of_loyalty_card');
                    $extension = $image->getClientOriginalExtension(); // getting image extension
                    $filename ='public/media/image_of_loyalty_card/'.$image->getClientOriginalName();
                    $path = public_path('/media/image_of_loyalty_card/');
                    $image->move($path, $filename);
                    $input['image_of_loyalty_card'] = $filename;
                }else
                {
                    $input['image_of_loyalty_card'] = '';
                }

                $stampMaster = $this->stampMasterRepository->create($input);
                  for ($i=0; $i<count($request->nfc_code); $i++) {
                    $segments_data = new \App\Models\Nfc_code;
                    $latest = \App\Models\Stamp_master::orderBy('id','DESC')->select('id')->first();
                    $segments_data->stamp_id = $latest->id;
                    $segments_data->nfc_code = $request->nfc_code[$i];
                    $segments_data->save();
                
            }

            Flash::success('Stamp Master saved successfully.');

            return redirect(route('stampMasters.index'));
        }
        else
        {
            Flash::error('The business has already been taken..');

            return redirect(route('stampMasters.index'));
        }
    }

    /**
     * Display the specified Stamp_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stampMaster = $this->stampMasterRepository->find($id);

        if (empty($stampMaster)) {
            Flash::error('Stamp Master not found');

            return redirect(route('stampMasters.index'));
        }

        return view('stamp_masters.show')->with('stampMaster', $stampMaster);
    }

    /**
     * Show the form for editing the specified Stamp_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stampMaster = $this->stampMasterRepository->find($id);
        $brands = \App\Models\Brand::where('stamp_point','1')->where('status','1')->pluck('name','id');
        $country_data = \App\Models\Country::where('status','1')->where('id',$stampMaster->country_id)->pluck('country_name','id');
        $currency_data = \DB::table('currency')->pluck('currency_code','id');
        $segment_data = \App\Models\Segment::where('status','1')->pluck('segment_name','id');
        if (empty($stampMaster)) {
            Flash::error('Stamp Master not found');

            return redirect(route('stampMasters.index'));
        }

        return view('stamp_masters.edit',compact('brands','country_data','currency_data','segment_data'))->with('stampMaster', $stampMaster);
    }

    /**
     * Update the specified Stamp_master in storage.
     *
     * @param  int              $id
     * @param UpdateStamp_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStamp_masterRequest $request)
    {
        $stampMaster = $this->stampMasterRepository->find($id);

        if (empty($stampMaster)) {
            Flash::error('Stamp Master not found');

            return redirect(route('stampMasters.index'));
        }


        $input = $request->all();
        if($request->hasfile('image_of_loyalty_card'))
        {

            $image = $request->file('image_of_loyalty_card');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/image_of_loyalty_card/'.$image->getClientOriginalName();
            $path = public_path('/media/image_of_loyalty_card/');
            $image->move($path, $filename);
            $input['image_of_loyalty_card'] = $filename;
        }else
        {
            $input['image_of_loyalty_card'] = $stampMaster['image_of_loyalty_card'];
        }
        $stampMaster = $this->stampMasterRepository->update($input, $id);
        $data = Date('Y-m-d : h:s:i');
        $question_details = \App\Models\Nfc_code::where('stamp_id', $id)->update(['deleted_at' => $data]);

        for ($i=0; $i<count($request->nfc_code); $i++) {
                    $segments_data = new \App\Models\Nfc_code;
                    $latest = \App\Models\Stamp_master::orderBy('id','DESC')->select('id')->first();
                    $segments_data->stamp_id = $id;
                    $segments_data->nfc_code = $request->nfc_code[$i];
                    $segments_data->save();
                
            }
        Flash::success('Stamp Master updated successfully.');

        return redirect(route('stampMasters.index'));
    }

    /**
     * Remove the specified Stamp_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stampMaster = $this->stampMasterRepository->find($id);

        if (empty($stampMaster)) {
            Flash::error('Stamp Master not found');

            return redirect(route('stampMasters.index'));
        }

        $this->stampMasterRepository->delete($id);
        $data = Date('Y-m-d : h:s:i');
        $question_details = \App\Models\Nfc_code::where('stamp_id', $id)->update(['deleted_at' => $data]);

        Flash::success('Stamp Master deleted successfully.');

        return redirect(route('stampMasters.index'));
    }
}
