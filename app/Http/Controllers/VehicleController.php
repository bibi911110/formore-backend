<?php

namespace App\Http\Controllers;

use App\DataTables\VehicleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Repositories\VehicleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class VehicleController extends AppBaseController
{
    /** @var  VehicleRepository */
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->vehicleRepository = $vehicleRepo;

        $this->middleware('permission:vehicles-index|vehicles-create|vehicles-edit|vehicles-delete', ['only' => ['index','store']]);
        $this->middleware('permission:vehicles-create', ['only' => ['create','store']]);
        $this->middleware('permission:vehicles-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vehicles-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Vehicle.
     *
     * @param VehicleDataTable $vehicleDataTable
     * @return Response
     */
    public function index(VehicleDataTable $vehicleDataTable)
    {
        
        $data = \App\Models\Vehicle::orderBy('id','DESC')->get();
        return view('vehicles.index',compact('data'));
        //return $vehicleDataTable->render('vehicles.index');
    }

    /**
     * Show the form for creating a new Vehicle.
     *
     * @return Response
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created Vehicle in storage.
     *
     * @param CreateVehicleRequest $request
     *
     * @return Response
     */
    public function store(CreateVehicleRequest $request)
    {
        $input = $request->all();
         $input['status'] = '1';
        $vehicle = $this->vehicleRepository->create($input);

        Flash::success('Vehicle saved successfully.');

        return redirect(route('vehicles.index'));
    }

    /**
     * Display the specified Vehicle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        return view('vehicles.show')->with('vehicle', $vehicle);
    }

    /**
     * Show the form for editing the specified Vehicle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        return view('vehicles.edit')->with('vehicle', $vehicle);
    }

    /**
     * Update the specified Vehicle in storage.
     *
     * @param  int              $id
     * @param UpdateVehicleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehicleRequest $request)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        $vehicle = $this->vehicleRepository->update($request->all(), $id);

        Flash::success('Vehicle updated successfully.');

        return redirect(route('vehicles.index'));
    }

    /**
     * Remove the specified Vehicle from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        $this->vehicleRepository->delete($id);

        Flash::success('Vehicle deleted successfully.');

        return redirect(route('vehicles.index'));
    }
    public function vehicle_status($id, $status)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $vehicle = $this->vehicleRepository->update($data, $id);

        Flash::success('Vehicle status updated successfully.');

        return redirect(route('vehicles.index'));
    }
}
