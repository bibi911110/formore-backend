<?php

namespace App\Http\Controllers;

use App\DataTables\Gallery_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateGallery_masterRequest;
use App\Http\Requests\UpdateGallery_masterRequest;
use App\Repositories\Gallery_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Gallery_masterController extends AppBaseController
{
    /** @var  Gallery_masterRepository */
    private $galleryMasterRepository;

    public function __construct(Gallery_masterRepository $galleryMasterRepo)
    {
        $this->galleryMasterRepository = $galleryMasterRepo;

        $this->middleware('permission:gallery_masters-index|gallery_masters-create|gallery_masters-edit|gallery_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:gallery_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:gallery_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gallery_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Gallery_master.
     *
     * @param Gallery_masterDataTable $galleryMasterDataTable
     * @return Response
     */
    public function index(Gallery_masterDataTable $galleryMasterDataTable)
    {
        // return $galleryMasterDataTable->render('gallery_masters.index');
        $data = \App\Models\Gallery_master::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('gallery_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Gallery_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('gallery_masters.create');
    }

    /**
     * Store a newly created Gallery_master in storage.
     *
     * @param CreateGallery_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateGallery_masterRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('gallery_img'))
        {

            $image = $request->file('gallery_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/gallery_img/'.$image->getClientOriginalName();
            $path = public_path('/media/gallery_img/');
            $image->move($path, $filename);
            $input['gallery_img'] = $filename;
        }else
        {
          $input['gallery_img'] = '';
        }
        $input['user_id'] = Auth::user()->id;

        $galleryMaster = $this->galleryMasterRepository->create($input);

        Flash::success('Gallery Master saved successfully.');

        return redirect(route('galleryMasters.index'));
    }

    /**
     * Display the specified Gallery_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            Flash::error('Gallery Master not found');

            return redirect(route('galleryMasters.index'));
        }

        return view('gallery_masters.show')->with('galleryMaster', $galleryMaster);
    }

    /**
     * Show the form for editing the specified Gallery_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            Flash::error('Gallery Master not found');

            return redirect(route('galleryMasters.index'));
        }

        return view('gallery_masters.edit')->with('galleryMaster', $galleryMaster);
    }

    /**
     * Update the specified Gallery_master in storage.
     *
     * @param  int              $id
     * @param UpdateGallery_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGallery_masterRequest $request)
    {
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            Flash::error('Gallery Master not found');

            return redirect(route('galleryMasters.index'));
        }
          $input = $request->all();
        if($request->hasfile('gallery_img'))
        {

            $image = $request->file('gallery_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/gallery_img/'.$image->getClientOriginalName();
            $path = public_path('/media/gallery_img/');
            $image->move($path, $filename);
            $input['gallery_img'] = $filename;
        }else
        {
          $input['gallery_img'] = $galleryMaster['gallery_img'];
        }

        $galleryMaster = $this->galleryMasterRepository->update($input, $id);

        Flash::success('Gallery Master updated successfully.');

        return redirect(route('galleryMasters.index'));
    }

    /**
     * Remove the specified Gallery_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            Flash::error('Gallery Master not found');

            return redirect(route('galleryMasters.index'));
        }

        $this->galleryMasterRepository->delete($id);

        Flash::success('Gallery Master deleted successfully.');

        return redirect(route('galleryMasters.index'));
    }
}
