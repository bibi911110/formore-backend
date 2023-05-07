<?php

namespace App\Http\Controllers;

use App\DataTables\Link_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLink_masterRequest;
use App\Http\Requests\UpdateLink_masterRequest;
use App\Repositories\Link_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Link_masterController extends AppBaseController
{
    /** @var  Link_masterRepository */
    private $linkMasterRepository;

    public function __construct(Link_masterRepository $linkMasterRepo)
    {
        $this->linkMasterRepository = $linkMasterRepo;

        $this->middleware('permission:link_masters-index|link_masters-create|link_masters-edit|link_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:link_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:link_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:link_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Link_master.
     *
     * @param Link_masterDataTable $linkMasterDataTable
     * @return Response
     */
    public function index(Link_masterDataTable $linkMasterDataTable)
    {
        //return $linkMasterDataTable->render('link_masters.index');
        $data = \App\Models\Link_master::orderBy('id','DESC')->get();
        return view('link_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Link_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('link_masters.create');
    }

    /**
     * Store a newly created Link_master in storage.
     *
     * @param CreateLink_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateLink_masterRequest $request)
    {
        $input = $request->all();

        $linkMaster = $this->linkMasterRepository->create($input);

        Flash::success('Link Master saved successfully.');

        return redirect(route('linkMasters.index'));
    }

    /**
     * Display the specified Link_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            Flash::error('Link Master not found');

            return redirect(route('linkMasters.index'));
        }

        return view('link_masters.show')->with('linkMaster', $linkMaster);
    }

    /**
     * Show the form for editing the specified Link_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            Flash::error('Link Master not found');

            return redirect(route('linkMasters.index'));
        }
         $language = \App\Models\Language::where('status','1')->pluck('language_name','id');

        return view('link_masters.edit',compact('language'))->with('linkMaster', $linkMaster);
    }

    /**
     * Update the specified Link_master in storage.
     *
     * @param  int              $id
     * @param UpdateLink_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLink_masterRequest $request)
    {
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            Flash::error('Link Master not found');

            return redirect(route('linkMasters.index'));
        }

        $linkMaster = $this->linkMasterRepository->update($request->all(), $id);

        Flash::success('Link Master updated successfully.');

        return redirect(route('linkMasters.index'));
    }

    /**
     * Remove the specified Link_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            Flash::error('Link Master not found');

            return redirect(route('linkMasters.index'));
        }

        $this->linkMasterRepository->delete($id);

        Flash::success('Link Master deleted successfully.');

        return redirect(route('linkMasters.index'));
    }
}
