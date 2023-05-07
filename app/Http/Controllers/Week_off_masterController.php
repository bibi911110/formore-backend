<?php

namespace App\Http\Controllers;

use App\DataTables\Week_off_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWeek_off_masterRequest;
use App\Http\Requests\UpdateWeek_off_masterRequest;
use App\Repositories\Week_off_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Week_off_masterController extends AppBaseController
{
    /** @var  Week_off_masterRepository */
    private $weekOffMasterRepository;

    public function __construct(Week_off_masterRepository $weekOffMasterRepo)
    {
        $this->weekOffMasterRepository = $weekOffMasterRepo;

        $this->middleware('permission:week_off_masters-index|week_off_masters-create|week_off_masters-edit|week_off_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:week_off_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:week_off_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:week_off_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Week_off_master.
     *
     * @param Week_off_masterDataTable $weekOffMasterDataTable
     * @return Response
     */
    public function index(Week_off_masterDataTable $weekOffMasterDataTable)
    {
        // return $weekOffMasterDataTable->render('week_off_masters.index');
        $data = \App\Models\Week_off_master::where('week_off_master.created_by',Auth::user()->id)
                            ->orderBy('week_off_master.id','DESC')
                            ->get();
        return view('week_off_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Week_off_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('week_off_masters.create');
    }

    /**
     * Store a newly created Week_off_master in storage.
     *
     * @param CreateWeek_off_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateWeek_off_masterRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        
        $weekOffMaster = $this->weekOffMasterRepository->create($input);

        Flash::success('Week Off Master saved successfully.');

        return redirect(route('weekOffMasters.index'));
    }

    /**
     * Display the specified Week_off_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            Flash::error('Week Off Master not found');

            return redirect(route('weekOffMasters.index'));
        }

        return view('week_off_masters.show')->with('weekOffMaster', $weekOffMaster);
    }

    /**
     * Show the form for editing the specified Week_off_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            Flash::error('Week Off Master not found');

            return redirect(route('weekOffMasters.index'));
        }

        return view('week_off_masters.edit')->with('weekOffMaster', $weekOffMaster);
    }

    /**
     * Update the specified Week_off_master in storage.
     *
     * @param  int              $id
     * @param UpdateWeek_off_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeek_off_masterRequest $request)
    {
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            Flash::error('Week Off Master not found');

            return redirect(route('weekOffMasters.index'));
        }

        $weekOffMaster = $this->weekOffMasterRepository->update($request->all(), $id);

        Flash::success('Week Off Master updated successfully.');

        return redirect(route('weekOffMasters.index'));
    }

    /**
     * Remove the specified Week_off_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            Flash::error('Week Off Master not found');

            return redirect(route('weekOffMasters.index'));
        }

        $this->weekOffMasterRepository->delete($id);

        Flash::success('Week Off Master deleted successfully.');

        return redirect(route('weekOffMasters.index'));
    }
}
