<?php

namespace App\Http\Controllers;

use App\DataTables\Extra_servicesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExtra_servicesRequest;
use App\Http\Requests\UpdateExtra_servicesRequest;
use App\Repositories\Extra_servicesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;


class Extra_servicesController extends AppBaseController
{
    /** @var  Extra_servicesRepository */
    private $extraServicesRepository;

    public function __construct(Extra_servicesRepository $extraServicesRepo)
    {
        $this->extraServicesRepository = $extraServicesRepo;

        $this->middleware('permission:extra_services-index|extra_services-create|extra_services-edit|extra_services-delete', ['only' => ['index','store']]);
        $this->middleware('permission:extra_services-create', ['only' => ['create','store']]);
        $this->middleware('permission:extra_services-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:extra_services-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Extra_services.
     *
     * @param Extra_servicesDataTable $extraServicesDataTable
     * @return Response
     */
    public function index(Extra_servicesDataTable $extraServicesDataTable)
    {
        // return $extraServicesDataTable->render('extra_services.index');
        $data = \App\Models\Extra_services::where('extra_services.created_by',Auth::user()->id)
                            ->orderBy('extra_services.id','DESC')
                            ->leftjoin('services_product','extra_services.product_id','services_product.id')
                            ->select('extra_services.*','services_product.name as prodcutName')->get();
                            
        return view('extra_services.index',compact('data'));
    }

    /**
     * Show the form for creating a new Extra_services.
     *
     * @return Response
     */
    public function create()
    {
        $product = \App\Models\Services_product::where('created_by',Auth::user()->id)->pluck('name','id');
        return view('extra_services.create',compact('product'));
    }

    /**
     * Store a newly created Extra_services in storage.
     *
     * @param CreateExtra_servicesRequest $request
     *
     * @return Response
     */
    public function store(CreateExtra_servicesRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $input['created_by'] = Auth::user()->id;

        $extraServices = $this->extraServicesRepository->create($input);

        Flash::success('Extra Services saved successfully.');

        return redirect(route('extraServices.index'));
    }

    /**
     * Display the specified Extra_services.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            Flash::error('Extra Services not found');

            return redirect(route('extraServices.index'));
        }

        return view('extra_services.show')->with('extraServices', $extraServices);
    }

    /**
     * Show the form for editing the specified Extra_services.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            Flash::error('Extra Services not found');

            return redirect(route('extraServices.index'));
        }
         $product = \App\Models\Services_product::where('created_by',Auth::user()->id)->pluck('name','id');
        return view('extra_services.edit',compact('product'))->with('extraServices', $extraServices);
    }

    /**
     * Update the specified Extra_services in storage.
     *
     * @param  int              $id
     * @param UpdateExtra_servicesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExtra_servicesRequest $request)
    {
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            Flash::error('Extra Services not found');

            return redirect(route('extraServices.index'));
        }

        $extraServices = $this->extraServicesRepository->update($request->all(), $id);

        Flash::success('Extra Services updated successfully.');

        return redirect(route('extraServices.index'));
    }

    /**
     * Remove the specified Extra_services from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            Flash::error('Extra Services not found');

            return redirect(route('extraServices.index'));
        }

        $this->extraServicesRepository->delete($id);

        Flash::success('Extra Services deleted successfully.');

        return redirect(route('extraServices.index'));
    }
    public function service_extra_status($id, $status)
    {

        $category = $this->extraServicesRepository->find($id);

        if (empty($category)) {
            Flash::error('Extra Services not found');

            return redirect(route('extraServices.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $category = $this->extraServicesRepository->update($data, $id);

        Flash::success('Extra Services status updated successfully.');

        return redirect(route('extraServices.index'));
    }
}
