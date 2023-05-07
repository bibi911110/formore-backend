<?php

namespace App\Http\Controllers;

use App\DataTables\Faqs_businessDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFaqs_businessRequest;
use App\Http\Requests\UpdateFaqs_businessRequest;
use App\Repositories\Faqs_businessRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Faqs_businessController extends AppBaseController
{
    /** @var  Faqs_businessRepository */
    private $faqsBusinessRepository;

    public function __construct(Faqs_businessRepository $faqsBusinessRepo)
    {
        $this->faqsBusinessRepository = $faqsBusinessRepo;

        $this->middleware('permission:faqs_businesses-index|faqs_businesses-create|faqs_businesses-edit|faqs_businesses-delete', ['only' => ['index','store']]);
        $this->middleware('permission:faqs_businesses-create', ['only' => ['create','store']]);
        $this->middleware('permission:faqs_businesses-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:faqs_businesses-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Faqs_business.
     *
     * @param Faqs_businessDataTable $faqsBusinessDataTable
     * @return Response
     */
    public function index(Faqs_businessDataTable $faqsBusinessDataTable)
    {
        $data = \App\Models\Faqs_business::where('created_by',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('faqs_businesses.index',compact('data'));
        
    }

    public function faq_user_wise()
    {
        $user_id = \App\User::where('user_type',3)->where('userDetailsId',Auth::user()->created_by)->first();
       /* echo "<pre>";
        print_r($user_id); exit;*/
        $data = \App\Models\Faqs_business::where('created_by',$user_id->id)->orderBy('id','DESC')->get();
        return view('faqs_businesses.faq_user',compact('data'));
    }

    /**
     * Show the form for creating a new Faqs_business.
     *
     * @return Response
     */
    public function create()
    {
        return view('faqs_businesses.create');
    }

    /**
     * Store a newly created Faqs_business in storage.
     *
     * @param CreateFaqs_businessRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqs_businessRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;

        $faqsBusiness = $this->faqsBusinessRepository->create($input);

        Flash::success('Faqs Business saved successfully.');

        return redirect(route('faqsBusinesses.index'));
    }

    /**
     * Display the specified Faqs_business.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            Flash::error('Faqs Business not found');

            return redirect(route('faqsBusinesses.index'));
        }

        return view('faqs_businesses.show')->with('faqsBusiness', $faqsBusiness);
    }

    /**
     * Show the form for editing the specified Faqs_business.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            Flash::error('Faqs Business not found');

            return redirect(route('faqsBusinesses.index'));
        }

        return view('faqs_businesses.edit')->with('faqsBusiness', $faqsBusiness);
    }

    /**
     * Update the specified Faqs_business in storage.
     *
     * @param  int              $id
     * @param UpdateFaqs_businessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqs_businessRequest $request)
    {
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            Flash::error('Faqs Business not found');

            return redirect(route('faqsBusinesses.index'));
        }

        $faqsBusiness = $this->faqsBusinessRepository->update($request->all(), $id);

        Flash::success('Faqs Business updated successfully.');

        return redirect(route('faqsBusinesses.index'));
    }

    /**
     * Remove the specified Faqs_business from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            Flash::error('Faqs Business not found');

            return redirect(route('faqsBusinesses.index'));
        }

        $this->faqsBusinessRepository->delete($id);

        Flash::success('Faqs Business deleted successfully.');

        return redirect(route('faqsBusinesses.index'));
    }
}
