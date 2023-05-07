<?php

namespace App\Http\Controllers;

use App\DataTables\Coupon_master_servicesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCoupon_master_servicesRequest;
use App\Http\Requests\UpdateCoupon_master_servicesRequest;
use App\Repositories\Coupon_master_servicesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Coupon_master_servicesController extends AppBaseController
{
    /** @var  Coupon_master_servicesRepository */
    private $couponMasterServicesRepository;

    public function __construct(Coupon_master_servicesRepository $couponMasterServicesRepo)
    {
        $this->couponMasterServicesRepository = $couponMasterServicesRepo;

        $this->middleware('permission:coupon_master_services-index|coupon_master_services-create|coupon_master_services-edit|coupon_master_services-delete', ['only' => ['index','store']]);
        $this->middleware('permission:coupon_master_services-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon_master_services-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupon_master_services-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Coupon_master_services.
     *
     * @param Coupon_master_servicesDataTable $couponMasterServicesDataTable
     * @return Response
     */
    public function index(Coupon_master_servicesDataTable $couponMasterServicesDataTable)
    {
        // return $couponMasterServicesDataTable->render('coupon_master_services.index');

        $data = \App\Models\Coupon_master_services::where('coupon_master_services.created_by',Auth::user()->id)
                            ->orderBy('coupon_master_services.id','DESC')
                            ->get();
                            
        return view('coupon_master_services.index',compact('data'));
    }

    /**
     * Show the form for creating a new Coupon_master_services.
     *
     * @return Response
     */
    public function create()
    {
         
        return view('coupon_master_services.create');
    }

    /**
     * Store a newly created Coupon_master_services in storage.
     *
     * @param CreateCoupon_master_servicesRequest $request
     *
     * @return Response
     */
    public function store(CreateCoupon_master_servicesRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $couponMasterServices = $this->couponMasterServicesRepository->create($input);

        Flash::success('Coupon Master Services saved successfully.');

        return redirect(route('couponMasterServices.index'));
    }

    /**
     * Display the specified Coupon_master_services.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            Flash::error('Coupon Master Services not found');

            return redirect(route('couponMasterServices.index'));
        }

        return view('coupon_master_services.show')->with('couponMasterServices', $couponMasterServices);
    }

    /**
     * Show the form for editing the specified Coupon_master_services.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            Flash::error('Coupon Master Services not found');

            return redirect(route('couponMasterServices.index'));
        }

        return view('coupon_master_services.edit')->with('couponMasterServices', $couponMasterServices);
    }

    /**
     * Update the specified Coupon_master_services in storage.
     *
     * @param  int              $id
     * @param UpdateCoupon_master_servicesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoupon_master_servicesRequest $request)
    {
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            Flash::error('Coupon Master Services not found');

            return redirect(route('couponMasterServices.index'));
        }

        $couponMasterServices = $this->couponMasterServicesRepository->update($request->all(), $id);

        Flash::success('Coupon Master Services updated successfully.');

        return redirect(route('couponMasterServices.index'));
    }

    /**
     * Remove the specified Coupon_master_services from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            Flash::error('Coupon Master Services not found');

            return redirect(route('couponMasterServices.index'));
        }

        $this->couponMasterServicesRepository->delete($id);

        Flash::success('Coupon Master Services deleted successfully.');

        return redirect(route('couponMasterServices.index'));
    }
}
