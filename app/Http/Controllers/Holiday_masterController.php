<?php

namespace App\Http\Controllers;

use App\DataTables\Holiday_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateHoliday_masterRequest;
use App\Http\Requests\UpdateHoliday_masterRequest;
use App\Repositories\Holiday_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;
class Holiday_masterController extends AppBaseController
{
    /** @var  Holiday_masterRepository */
    private $holidayMasterRepository;

    public function __construct(Holiday_masterRepository $holidayMasterRepo)
    {
        $this->holidayMasterRepository = $holidayMasterRepo;

        $this->middleware('permission:holiday_masters-index|holiday_masters-create|holiday_masters-edit|holiday_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:holiday_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:holiday_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:holiday_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Holiday_master.
     *
     * @param Holiday_masterDataTable $holidayMasterDataTable
     * @return Response
     */
    public function index(Holiday_masterDataTable $holidayMasterDataTable)
    {
        // return $holidayMasterDataTable->render('holiday_masters.index');
         $data = \App\Models\Holiday_master::where('holiday_master.created_by',Auth::user()->id)
                            ->orderBy('holiday_master.id','DESC')
                            ->get();
        return view('holiday_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Holiday_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('holiday_masters.create');
    }

    /**
     * Store a newly created Holiday_master in storage.
     *
     * @param CreateHoliday_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateHoliday_masterRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $holidayMaster = $this->holidayMasterRepository->create($input);

        Flash::success('Holiday Master saved successfully.');

        return redirect(route('holidayMasters.index'));
    }

    /**
     * Display the specified Holiday_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            Flash::error('Holiday Master not found');

            return redirect(route('holidayMasters.index'));
        }

        return view('holiday_masters.show')->with('holidayMaster', $holidayMaster);
    }

    /**
     * Show the form for editing the specified Holiday_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            Flash::error('Holiday Master not found');

            return redirect(route('holidayMasters.index'));
        }

        return view('holiday_masters.edit')->with('holidayMaster', $holidayMaster);
    }

    /**
     * Update the specified Holiday_master in storage.
     *
     * @param  int              $id
     * @param UpdateHoliday_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHoliday_masterRequest $request)
    {
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            Flash::error('Holiday Master not found');

            return redirect(route('holidayMasters.index'));
        }

        $holidayMaster = $this->holidayMasterRepository->update($request->all(), $id);

        Flash::success('Holiday Master updated successfully.');

        return redirect(route('holidayMasters.index'));
    }

    /**
     * Remove the specified Holiday_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            Flash::error('Holiday Master not found');

            return redirect(route('holidayMasters.index'));
        }

        $this->holidayMasterRepository->delete($id);

        Flash::success('Holiday Master deleted successfully.');

        return redirect(route('holidayMasters.index'));
    }
}
