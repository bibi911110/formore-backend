<?php

namespace App\Http\Controllers;

use App\DataTables\Nfc_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNfc_masterRequest;
use App\Http\Requests\UpdateNfc_masterRequest;
use App\Repositories\Nfc_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Nfc_masterController extends AppBaseController
{
    /** @var  Nfc_masterRepository */
    private $nfcMasterRepository;

    public function __construct(Nfc_masterRepository $nfcMasterRepo)
    {
        $this->nfcMasterRepository = $nfcMasterRepo;

        $this->middleware('permission:nfc_masters-index|nfc_masters-create|nfc_masters-edit|nfc_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:nfc_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:nfc_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:nfc_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Nfc_master.
     *
     * @param Nfc_masterDataTable $nfcMasterDataTable
     * @return Response
     */
    public function index(Nfc_masterDataTable $nfcMasterDataTable)
    {
        // return $nfcMasterDataTable->render('nfc_masters.index');
        $data = \App\Models\Nfc_master::leftJoin('brand','nfc_master.buss_id','brand.id')->orderBy('id','DESC')
                        ->select('nfc_master.*','brand.name as bussName')
                        ->get();
        return view('nfc_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Nfc_master.
     *
     * @return Response
     */
    public function create()
    {
        $buss = \App\Models\Brand::where('status','1')->pluck('name','id');

        return view('nfc_masters.create',compact('buss'));
    }

    /**
     * Store a newly created Nfc_master in storage.
     *
     * @param CreateNfc_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateNfc_masterRequest $request)
    {
        $input = $request->all();

        $nfcMaster = $this->nfcMasterRepository->create($input);

        Flash::success('Nfc Master saved successfully.');

        return redirect(route('nfcMasters.index'));
    }

    /**
     * Display the specified Nfc_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            Flash::error('Nfc Master not found');

            return redirect(route('nfcMasters.index'));
        }

        return view('nfc_masters.show')->with('nfcMaster', $nfcMaster);
    }

    /**
     * Show the form for editing the specified Nfc_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $buss = \App\Models\Brand::where('status','1')->pluck('name','id');
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            Flash::error('Nfc Master not found');

            return redirect(route('nfcMasters.index'));
        }

        return view('nfc_masters.edit',compact('buss'))->with('nfcMaster', $nfcMaster);
    }

    /**
     * Update the specified Nfc_master in storage.
     *
     * @param  int              $id
     * @param UpdateNfc_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNfc_masterRequest $request)
    {
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            Flash::error('Nfc Master not found');

            return redirect(route('nfcMasters.index'));
        }

        $nfcMaster = $this->nfcMasterRepository->update($request->all(), $id);

        Flash::success('Nfc Master updated successfully.');

        return redirect(route('nfcMasters.index'));
    }

    /**
     * Remove the specified Nfc_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            Flash::error('Nfc Master not found');

            return redirect(route('nfcMasters.index'));
        }

        $this->nfcMasterRepository->delete($id);

        Flash::success('Nfc Master deleted successfully.');

        return redirect(route('nfcMasters.index'));
    }
}
