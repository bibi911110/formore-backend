<?php

namespace App\Http\Controllers;

use App\DataTables\Gift_vocher_typesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateGift_vocher_typesRequest;
use App\Http\Requests\UpdateGift_vocher_typesRequest;
use App\Repositories\Gift_vocher_typesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Gift_vocher_typesController extends AppBaseController
{
    /** @var  Gift_vocher_typesRepository */
    private $giftVocherTypesRepository;

    public function __construct(Gift_vocher_typesRepository $giftVocherTypesRepo)
    {
        $this->giftVocherTypesRepository = $giftVocherTypesRepo;

        $this->middleware('permission:gift_vocher_types-index|gift_vocher_types-create|gift_vocher_types-edit|gift_vocher_types-delete', ['only' => ['index','store']]);
        $this->middleware('permission:gift_vocher_types-create', ['only' => ['create','store']]);
        $this->middleware('permission:gift_vocher_types-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gift_vocher_types-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Gift_vocher_types.
     *
     * @param Gift_vocher_typesDataTable $giftVocherTypesDataTable
     * @return Response
     */
    public function index(Gift_vocher_typesDataTable $giftVocherTypesDataTable)
    {
       // return $giftVocherTypesDataTable->render('gift_vocher_types.index');
         $data = \App\Models\Gift_vocher_types::orderBy('id','DESC')->get();
        return view('gift_vocher_types.index',compact('data'));
    }

    /**
     * Show the form for creating a new Gift_vocher_types.
     *
     * @return Response
     */
    public function create()
    {
        return view('gift_vocher_types.create');
    }

    /**
     * Store a newly created Gift_vocher_types in storage.
     *
     * @param CreateGift_vocher_typesRequest $request
     *
     * @return Response
     */
    public function store(CreateGift_vocher_typesRequest $request)
    {
        $input = $request->all();

        $giftVocherTypes = $this->giftVocherTypesRepository->create($input);

        Flash::success('Gift Vocher Types saved successfully.');

        return redirect(route('giftVocherTypes.index'));
    }

    /**
     * Display the specified Gift_vocher_types.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            Flash::error('Gift Vocher Types not found');

            return redirect(route('giftVocherTypes.index'));
        }

        return view('gift_vocher_types.show')->with('giftVocherTypes', $giftVocherTypes);
    }

    /**
     * Show the form for editing the specified Gift_vocher_types.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            Flash::error('Gift Vocher Types not found');

            return redirect(route('giftVocherTypes.index'));
        }

        return view('gift_vocher_types.edit')->with('giftVocherTypes', $giftVocherTypes);
    }

    /**
     * Update the specified Gift_vocher_types in storage.
     *
     * @param  int              $id
     * @param UpdateGift_vocher_typesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGift_vocher_typesRequest $request)
    {
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            Flash::error('Gift Vocher Types not found');

            return redirect(route('giftVocherTypes.index'));
        }

        $giftVocherTypes = $this->giftVocherTypesRepository->update($request->all(), $id);

        Flash::success('Gift Vocher Types updated successfully.');

        return redirect(route('giftVocherTypes.index'));
    }

    /**
     * Remove the specified Gift_vocher_types from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            Flash::error('Gift Vocher Types not found');

            return redirect(route('giftVocherTypes.index'));
        }

        $this->giftVocherTypesRepository->delete($id);

        Flash::success('Gift Vocher Types deleted successfully.');

        return redirect(route('giftVocherTypes.index'));
    }
     public function gift_vocher_status($id, $status)
    {

        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            Flash::error('Gift Vocher Types not found');

            return redirect(route('giftVocherTypes.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $giftVocherTypes = $this->giftVocherTypesRepository->update($data, $id);

        Flash::success('Gift Vocher Types status updated successfully.');

        return redirect(route('giftVocherTypes.index'));
    }
}
