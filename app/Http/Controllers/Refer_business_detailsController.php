<?php

namespace App\Http\Controllers;

use App\DataTables\Refer_business_detailsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRefer_business_detailsRequest;
use App\Http\Requests\UpdateRefer_business_detailsRequest;
use App\Repositories\Refer_business_detailsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Refer_business_detailsController extends AppBaseController
{
    /** @var  Refer_business_detailsRepository */
    private $referBusinessDetailsRepository;

    public function __construct(Refer_business_detailsRepository $referBusinessDetailsRepo)
    {
        $this->referBusinessDetailsRepository = $referBusinessDetailsRepo;

        $this->middleware('permission:refer_business_details-index|refer_business_details-create|refer_business_details-edit|refer_business_details-delete', ['only' => ['index','store']]);
        $this->middleware('permission:refer_business_details-create', ['only' => ['create','store']]);
        $this->middleware('permission:refer_business_details-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:refer_business_details-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Refer_business_details.
     *
     * @param Refer_business_detailsDataTable $referBusinessDetailsDataTable
     * @return Response
     */
    public function index(Refer_business_detailsDataTable $referBusinessDetailsDataTable)
    {
        //return $referBusinessDetailsDataTable->render('refer_business_details.index');
        $data = \App\Models\Refer_business_details::orderBy('id','DESC')->get();
        return view('refer_business_details.index',compact('data'));
    }

    /**
     * Show the form for creating a new Refer_business_details.
     *
     * @return Response
     */
    public function create()
    {
        return view('refer_business_details.create');
    }

    /**
     * Store a newly created Refer_business_details in storage.
     *
     * @param CreateRefer_business_detailsRequest $request
     *
     * @return Response
     */
    public function store(CreateRefer_business_detailsRequest $request)
    {
        $input = $request->all();

        $referBusinessDetails = $this->referBusinessDetailsRepository->create($input);

        Flash::success('Refer Business Details saved successfully.');

        return redirect(route('referBusinessDetails.index'));
    }

    /**
     * Display the specified Refer_business_details.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            Flash::error('Refer Business Details not found');

            return redirect(route('referBusinessDetails.index'));
        }

        return view('refer_business_details.show')->with('referBusinessDetails', $referBusinessDetails);
    }

    /**
     * Show the form for editing the specified Refer_business_details.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            Flash::error('Refer Business Details not found');

            return redirect(route('referBusinessDetails.index'));
        }

        return view('refer_business_details.edit')->with('referBusinessDetails', $referBusinessDetails);
    }

    /**
     * Update the specified Refer_business_details in storage.
     *
     * @param  int              $id
     * @param UpdateRefer_business_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRefer_business_detailsRequest $request)
    {
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            Flash::error('Refer Business Details not found');

            return redirect(route('referBusinessDetails.index'));
        }

        $referBusinessDetails = $this->referBusinessDetailsRepository->update($request->all(), $id);

        Flash::success('Refer Business Details updated successfully.');

        return redirect(route('referBusinessDetails.index'));
    }

    /**
     * Remove the specified Refer_business_details from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            Flash::error('Refer Business Details not found');

            return redirect(route('referBusinessDetails.index'));
        }

        $this->referBusinessDetailsRepository->delete($id);

        Flash::success('Refer Business Details deleted successfully.');

        return redirect(route('referBusinessDetails.index'));
    }
}
