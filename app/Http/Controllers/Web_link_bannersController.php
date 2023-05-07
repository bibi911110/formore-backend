<?php

namespace App\Http\Controllers;

use App\DataTables\Web_link_bannersDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWeb_link_bannersRequest;
use App\Http\Requests\UpdateWeb_link_bannersRequest;
use App\Repositories\Web_link_bannersRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Web_link_bannersController extends AppBaseController
{
    /** @var  Web_link_bannersRepository */
    private $webLinkBannersRepository;

    public function __construct(Web_link_bannersRepository $webLinkBannersRepo)
    {
        $this->webLinkBannersRepository = $webLinkBannersRepo;

        $this->middleware('permission:web_link_banners-index|web_link_banners-create|web_link_banners-edit|web_link_banners-delete', ['only' => ['index','store']]);
        $this->middleware('permission:web_link_banners-create', ['only' => ['create','store']]);
        $this->middleware('permission:web_link_banners-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:web_link_banners-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Web_link_banners.
     *
     * @param Web_link_bannersDataTable $webLinkBannersDataTable
     * @return Response
     */
    public function index(Web_link_bannersDataTable $webLinkBannersDataTable)
    {
         $data = \App\Models\Web_link_banners::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('web_link_banners.index',compact('data'));
        //return $webLinkBannersDataTable->render('web_link_banners.index');
    }

    /**
     * Show the form for creating a new Web_link_banners.
     *
     * @return Response
     */
    public function create()
    {
        return view('web_link_banners.create');
    }

    /**
     * Store a newly created Web_link_banners in storage.
     *
     * @param CreateWeb_link_bannersRequest $request
     *
     * @return Response
     */
    public function store(CreateWeb_link_bannersRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('web_image'))
        {

            $image = $request->file('web_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/web_image/'.$image->getClientOriginalName();
            $path = public_path('/media/web_image/');
            $image->move($path, $filename);
            $input['web_image'] = $filename;
        }else
        {
          $input['web_image'] = '';
        }
        $input['user_id'] = Auth::user()->id;

        $webLinkBanners = $this->webLinkBannersRepository->create($input);

        Flash::success('Web Link Banners saved successfully.');

        return redirect(route('webLinkBanners.index'));
    }

    /**
     * Display the specified Web_link_banners.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            Flash::error('Web Link Banners not found');

            return redirect(route('webLinkBanners.index'));
        }

        return view('web_link_banners.show')->with('webLinkBanners', $webLinkBanners);
    }

    /**
     * Show the form for editing the specified Web_link_banners.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            Flash::error('Web Link Banners not found');

            return redirect(route('webLinkBanners.index'));
        }

        return view('web_link_banners.edit')->with('webLinkBanners', $webLinkBanners);
    }

    /**
     * Update the specified Web_link_banners in storage.
     *
     * @param  int              $id
     * @param UpdateWeb_link_bannersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeb_link_bannersRequest $request)
    {
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            Flash::error('Web Link Banners not found');

            return redirect(route('webLinkBanners.index'));
        }
        $input = $request->all();

        if($request->hasfile('web_image'))
        {

            $image = $request->file('web_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/web_image/'.$image->getClientOriginalName();
            $path = public_path('/media/web_image/');
            $image->move($path, $filename);
            $input['web_image'] = $filename;
        }else
        {
          $input['web_image'] = $webLinkBanners['web_image'];
        }
        $webLinkBanners = $this->webLinkBannersRepository->update($input, $id);

        Flash::success('Web Link Banners updated successfully.');

        return redirect(route('webLinkBanners.index'));
    }

    /**
     * Remove the specified Web_link_banners from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            Flash::error('Web Link Banners not found');

            return redirect(route('webLinkBanners.index'));
        }

        $this->webLinkBannersRepository->delete($id);

        Flash::success('Web Link Banners deleted successfully.');

        return redirect(route('webLinkBanners.index'));
    }
}
