<?php

namespace App\Http\Controllers;

use App\DataTables\Other_program_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOther_program_masterRequest;
use App\Http\Requests\UpdateOther_program_masterRequest;
use App\Repositories\Other_program_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Other_program_masterController extends AppBaseController
{
    /** @var  Other_program_masterRepository */
    private $otherProgramMasterRepository;

    public function __construct(Other_program_masterRepository $otherProgramMasterRepo)
    {
        $this->otherProgramMasterRepository = $otherProgramMasterRepo;

        $this->middleware('permission:other_program_masters-index|other_program_masters-create|other_program_masters-edit|other_program_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:other_program_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:other_program_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:other_program_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Other_program_master.
     *
     * @param Other_program_masterDataTable $otherProgramMasterDataTable
     * @return Response
     */
    public function index(Other_program_masterDataTable $otherProgramMasterDataTable)
    {
        //return $otherProgramMasterDataTable->render('other_program_masters.index');
        $data = \App\Models\Other_program_master::orderBy('other_program_master.id','DESC')
                                                ->leftjoin('users','other_program_master.buss_id','users.userDetailsId')
                                                ->leftjoin('brand','users.userDetailsId','brand.id')
                                                ->select('other_program_master.*','brand.name as bussName')
                                                ->get();
        return view('other_program_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Other_program_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('other_program_masters.create');
    }

    /**
     * Store a newly created Other_program_master in storage.
     *
     * @param CreateOther_program_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateOther_program_masterRequest $request)
    {
        $input = $request->all();

        $otherProgramMaster = $this->otherProgramMasterRepository->create($input);

        Flash::success('Other Program Master saved successfully.');

        return redirect(route('otherProgramMasters.index'));
    }

    /**
     * Display the specified Other_program_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            Flash::error('Other Program Master not found');

            return redirect(route('otherProgramMasters.index'));
        }

        return view('other_program_masters.show')->with('otherProgramMaster', $otherProgramMaster);
    }

    /**
     * Show the form for editing the specified Other_program_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            Flash::error('Other Program Master not found');

            return redirect(route('otherProgramMasters.index'));
        }

        return view('other_program_masters.edit')->with('otherProgramMaster', $otherProgramMaster);
    }

    /**
     * Update the specified Other_program_master in storage.
     *
     * @param  int              $id
     * @param UpdateOther_program_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOther_program_masterRequest $request)
    {
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            Flash::error('Other Program Master not found');

            return redirect(route('otherProgramMasters.index'));
        }
        $input = $request->all();
        if($request->hasfile('barcode_image'))
        {

            $image = $request->file('barcode_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/barcode_image/'.$image->getClientOriginalName();
            $path = public_path('/media/barcode_image/');
            $image->move($path, $filename);
            $input['barcode_image'] = $filename;
        }else
        {
          $input['barcode_image'] = $otherProgramMaster['barcode_image'];
        }
   
        if($request->hasfile('qr_code_img'))
        {

            $image = $request->file('qr_code_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/qr_code_img/'.$image->getClientOriginalName();
            $path = public_path('/media/qr_code_img/');
            $image->move($path, $filename);
            $input['qr_code_img'] = $filename;
        }else
        {
          $input['qr_code_img'] = $otherProgramMaster['qr_code_img'];
        }

        $otherProgramMaster = $this->otherProgramMasterRepository->update($input, $id);

        Flash::success('Other Program Master updated successfully.');

        return redirect(route('otherProgramMasters.index'));
    }

    /**
     * Remove the specified Other_program_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $otherProgramMaster = $this->otherProgramMasterRepository->find($id);

        if (empty($otherProgramMaster)) {
            Flash::error('Other Program Master not found');

            return redirect(route('otherProgramMasters.index'));
        }

        $this->otherProgramMasterRepository->delete($id);

        Flash::success('Other Program Master deleted successfully.');

        return redirect(route('otherProgramMasters.index'));
    }
}
