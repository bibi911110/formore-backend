<?php

namespace App\Http\Controllers;

use App\DataTables\Refer_businessDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRefer_businessRequest;
use App\Http\Requests\UpdateRefer_businessRequest;
use App\Repositories\Refer_businessRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Refer_businessController extends AppBaseController
{
    /** @var  Refer_businessRepository */
    private $referBusinessRepository;

    public function __construct(Refer_businessRepository $referBusinessRepo)
    {
        $this->referBusinessRepository = $referBusinessRepo;

        $this->middleware('permission:refer_businesses-index|refer_businesses-create|refer_businesses-edit|refer_businesses-delete', ['only' => ['index','store']]);
        $this->middleware('permission:refer_businesses-create', ['only' => ['create','store']]);
        $this->middleware('permission:refer_businesses-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:refer_businesses-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Refer_business.
     *
     * @param Refer_businessDataTable $referBusinessDataTable
     * @return Response
     */
    public function index(Refer_businessDataTable $referBusinessDataTable)
    {
        //return $referBusinessDataTable->render('refer_businesses.index');
        $data = \App\Models\Refer_business::orderBy('id','DESC')->get();
        return view('refer_businesses.index',compact('data'));
    }

    /**
     * Show the form for creating a new Refer_business.
     *
     * @return Response
     */
    public function create()
    {
        $language = \App\Models\Language::where('status','1')->pluck('language_name','id');
        return view('refer_businesses.create',compact('language'));
    }

    /**
     * Store a newly created Refer_business in storage.
     *
     * @param CreateRefer_businessRequest $request
     *
     * @return Response
     */
    public function store(CreateRefer_businessRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('refer_icon'))
        {

            $image = $request->file('refer_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/refer_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/refer_icon/');
            $image->move($path, $filename);
            $input['refer_icon'] = $filename;
        }else
        {
            $input['refer_icon'] = '';
        }

         if($request->hasfile('refer_icon1'))
        {

            $image = $request->file('refer_icon1');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/refer_icon1/'.$image->getClientOriginalName();
            $path = public_path('/media/refer_icon1/');
            $image->move($path, $filename);
            $input['refer_icon1'] = $filename;
        }else
        {
            $input['refer_icon1'] = '';
        }

         if($request->hasfile('refer_icon2'))
        {

            $image = $request->file('refer_icon2');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/refer_icon2/'.$image->getClientOriginalName();
            $path = public_path('/media/refer_icon2/');
            $image->move($path, $filename);
            $input['refer_icon2'] = $filename;
        }else
        {
            $input['refer_icon2'] = '';
        }
        $input['status'] = '1'; 
        $referBusiness = $this->referBusinessRepository->create($input);

        Flash::success('Refer Business saved successfully.');

        return redirect(route('referBusinesses.index'));
    }

    /**
     * Display the specified Refer_business.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            Flash::error('Refer Business not found');

            return redirect(route('referBusinesses.index'));
        }

        return view('refer_businesses.show')->with('referBusiness', $referBusiness);
    }

    /**
     * Show the form for editing the specified Refer_business.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            Flash::error('Refer Business not found');

            return redirect(route('referBusinesses.index'));
        }
        $language = \App\Models\Language::where('status','1')->pluck('language_name','id');

        return view('refer_businesses.edit',compact('language'))->with('referBusiness', $referBusiness);
    }

    /**
     * Update the specified Refer_business in storage.
     *
     * @param  int              $id
     * @param UpdateRefer_businessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRefer_businessRequest $request)
    {
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            Flash::error('Refer Business not found');

            return redirect(route('referBusinesses.index'));
        }
        $input = $request->all();
        if($request->hasfile('refer_icon'))
        {

            $image = $request->file('refer_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/refer_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/refer_icon/');
            $image->move($path, $filename);
            $input['refer_icon'] = $filename;
        }else
        {
            $input['refer_icon'] =  $referBusiness['refer_icon'];
        }

        if($request->hasfile('refer_icon1'))
        {

            $image = $request->file('refer_icon1');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/refer_icon1/'.$image->getClientOriginalName();
            $path = public_path('/media/refer_icon1/');
            $image->move($path, $filename);
            $input['refer_icon1'] = $filename;
        }else
        {
            $input['refer_icon'] =  $referBusiness['refer_icon1'];
        }

        if($request->hasfile('refer_icon2'))
        {

            $image = $request->file('refer_icon2');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/refer_icon2/'.$image->getClientOriginalName();
            $path = public_path('/media/refer_icon2/');
            $image->move($path, $filename);
            $input['refer_icon2'] = $filename;
        }else
        {
            $input['refer_icon'] =  $referBusiness['refer_icon2'];
        }

        $referBusiness = $this->referBusinessRepository->update($input, $id);

        Flash::success('Refer Business updated successfully.');

        return redirect(route('referBusinesses.index'));
    }

    /**
     * Remove the specified Refer_business from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            Flash::error('Refer Business not found');

            return redirect(route('referBusinesses.index'));
        }

        $this->referBusinessRepository->delete($id);

        Flash::success('Refer Business deleted successfully.');

        return redirect(route('referBusinesses.index'));
    }
    public function refer_business_status($id, $status)
    {

        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            Flash::error('Business not found');

            return redirect(route('referBusinesses.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $referBusiness = $this->referBusinessRepository->update($data, $id);

        Flash::success('Refer Business status updated successfully.');

        return redirect(route('referBusinesses.index'));
    }
}
