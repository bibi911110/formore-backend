<?php

namespace App\Http\Controllers;

use App\DataTables\Slot_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSlot_masterRequest;
use App\Http\Requests\UpdateSlot_masterRequest;
use App\Repositories\Slot_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Slot_masterController extends AppBaseController
{
    /** @var  Slot_masterRepository */
    private $slotMasterRepository;

    public function __construct(Slot_masterRepository $slotMasterRepo)
    {
        $this->slotMasterRepository = $slotMasterRepo;

        $this->middleware('permission:slot_masters-index|slot_masters-create|slot_masters-edit|slot_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:slot_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:slot_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slot_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Slot_master.
     *
     * @param Slot_masterDataTable $slotMasterDataTable
     * @return Response
     */
    public function index(Slot_masterDataTable $slotMasterDataTable)
    {
        $data = \App\Models\Slot_master::where('slot_master.created_by',Auth::user()->id)
                            ->orderBy('slot_master.id','DESC')
                            ->get();
        return view('slot_masters.index',compact('data'));
        //return $slotMasterDataTable->render('slot_masters.index');
    }

    /**
     * Show the form for creating a new Slot_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('slot_masters.create');
    }

    /**
     * Store a newly created Slot_master in storage.
     *
     * @param CreateSlot_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateSlot_masterRequest $request)
    {
        $input = $request->all();

        $duration = 60; // how much the is the duration of a time slot
            $cleanup    = 0; // don't mind this

            $start         =  new \DateTime($request->start_time);
            $end           =  new \DateTime($request->end_time);
            $interval      = new \DateInterval("PT" . $duration . "M");
            $cleanupInterval = new \DateInterval("PT" . $cleanup . "M");
            $periods = array();
            for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
                $endPeriod = clone $intStart;
                $endPeriod->add($interval);
                if ($endPeriod > $end) {
                    break;
                }
                //$periods[] = $intStart->format('H:i A') . ' - ' . $endPeriod->format('H:i A');
                $periods[] = $intStart->format('H:i') . ' - ' . $endPeriod->format('H:i');
            }

        $input['created_by'] = Auth::user()->id;

        $slotMaster = $this->slotMasterRepository->create($input);

        foreach ($periods as  $value) {

            $slot['business_id'] = Auth::user()->id;
            $slot['slot_time'] = $value;
            $slot['limit_per_slot'] = $request->pepole_per_slot;
            $slot['slot_price'] = $request->price_per_slot;

            $insert = \App\Models\Slot_timing::create($slot);
            
        }

        Flash::success('Slot Master saved successfully.');

        return redirect(route('slotMasters.index'));
    }

    /**
     * Display the specified Slot_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            Flash::error('Slot Master not found');

            return redirect(route('slotMasters.index'));
        }

        return view('slot_masters.show')->with('slotMaster', $slotMaster);
    }

    /**
     * Show the form for editing the specified Slot_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            Flash::error('Slot Master not found');

            return redirect(route('slotMasters.index'));
        }

        return view('slot_masters.edit')->with('slotMaster', $slotMaster);
    }

    /**
     * Update the specified Slot_master in storage.
     *
     * @param  int              $id
     * @param UpdateSlot_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSlot_masterRequest $request)
    {
            $duration = 60; // how much the is the duration of a time slot
            $cleanup    = 0; // don't mind this

            $start         =  new \DateTime($request->start_time);
            $end           =  new \DateTime($request->end_time);
            $interval      = new \DateInterval("PT" . $duration . "M");
            $cleanupInterval = new \DateInterval("PT" . $cleanup . "M");
            $periods = array();
            for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
                $endPeriod = clone $intStart;
                $endPeriod->add($interval);
                if ($endPeriod > $end) {
                    break;
                }
                //$periods[] = $intStart->format('H:i A') . ' - ' . $endPeriod->format('H:i A');
                $periods[] = $intStart->format('H:i') . ' - ' . $endPeriod->format('H:i');
            }


        
        
        
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            Flash::error('Slot Master not found');

            return redirect(route('slotMasters.index'));
        }

        $slotMaster = $this->slotMasterRepository->update($request->all(), $id);
        foreach ($periods as  $value) {

            $slot['business_id'] = Auth::user()->id;
            $slot['slot_time'] = $value;
            $slot['limit_per_slot'] = $request->pepole_per_slot;
            $slot['slot_price'] = $request->price_per_slot;

            $insert = \App\Models\Slot_timing::create($slot);
            
        }


        Flash::success('Slot Master updated successfully.');

        return redirect(route('slotMasters.index'));
    }

    /**
     * Remove the specified Slot_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            Flash::error('Slot Master not found');

            return redirect(route('slotMasters.index'));
        }

        $this->slotMasterRepository->delete($id);

        Flash::success('Slot Master deleted successfully.');

        return redirect(route('slotMasters.index'));
    }
}
