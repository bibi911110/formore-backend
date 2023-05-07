<?php

namespace App\Http\Controllers;

use App\DataTables\Offer_bannerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOffer_bannerRequest;
use App\Http\Requests\UpdateOffer_bannerRequest;
use App\Repositories\Offer_bannerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Offer_bannerController extends AppBaseController
{
    /** @var  Offer_bannerRepository */
    private $offerBannerRepository;

    public function __construct(Offer_bannerRepository $offerBannerRepo)
    {
        $this->offerBannerRepository = $offerBannerRepo;

        $this->middleware('permission:offer_banners-index|offer_banners-create|offer_banners-edit|offer_banners-delete', ['only' => ['index','store']]);
        $this->middleware('permission:offer_banners-create', ['only' => ['create','store']]);
        $this->middleware('permission:offer_banners-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:offer_banners-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Offer_banner.
     *
     * @param Offer_bannerDataTable $offerBannerDataTable
     * @return Response
     */
    public function index(Offer_bannerDataTable $offerBannerDataTable)
    {
        $data = \App\Models\Offer_banner::where('user_id',Auth::user()->id)
                                        ->leftjoin('category','offer_banner.cat_id','category.id')
                                        ->select('offer_banner.*','category.name as catName')
                                        ->orderBy('id','DESC')->get();
        return view('offer_banners.index',compact('data'));
       // return $offerBannerDataTable->render('offer_banners.index');
    }

    /**
     * Show the form for creating a new Offer_banner.
     *
     * @return Response
     */
    public function create()
    {
         $category = \App\Models\Category::where('status','1')->pluck('name','id');
        return view('offer_banners.create',compact('category'));
    }

    /**
     * Store a newly created Offer_banner in storage.
     *
     * @param CreateOffer_bannerRequest $request
     *
     * @return Response
     */
    public function store(CreateOffer_bannerRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('offer_image'))
        {

            $image = $request->file('offer_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/offer_image/'.$image->getClientOriginalName();
            $path = public_path('/media/offer_image/');
            $image->move($path, $filename);
            $input['offer_image'] = $filename;
        }else
        {
          $input['offer_image'] = '';
        }

        if($request->hasfile('deals_banner_image'))
        {

            $image = $request->file('deals_banner_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/deals_banner_image/'.$image->getClientOriginalName();
            $path = public_path('/media/deals_banner_image/');
            $image->move($path, $filename);
            $input['deals_banner_image'] = $filename;
        }else
        {
          $input['deals_banner_image'] = '';
        }
        $input['user_id'] = Auth::user()->id;

        $offerBanner = $this->offerBannerRepository->create($input);

        Flash::success('Offer Banner saved successfully.');

        return redirect(route('offerBanners.index'));
    }

    /**
     * Display the specified Offer_banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            Flash::error('Offer Banner not found');

            return redirect(route('offerBanners.index'));
        }

        return view('offer_banners.show')->with('offerBanner', $offerBanner);
    }

    /**
     * Show the form for editing the specified Offer_banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            Flash::error('Offer Banner not found');

            return redirect(route('offerBanners.index'));
        }
        $category = \App\Models\Category::where('status','1')->pluck('name','id');

        return view('offer_banners.edit',compact('category'))->with('offerBanner', $offerBanner);
    }

    /**
     * Update the specified Offer_banner in storage.
     *
     * @param  int              $id
     * @param UpdateOffer_bannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOffer_bannerRequest $request)
    {
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            Flash::error('Offer Banner not found');

            return redirect(route('offerBanners.index'));
        }

        $input = $request->all();

        if($request->hasfile('offer_image'))
        {

            $image = $request->file('offer_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/offer_image/'.$image->getClientOriginalName();
            $path = public_path('/media/offer_image/');
            $image->move($path, $filename);
            $input['offer_image'] = $filename;
        }else
        {
          $input['offer_image'] = $offerBanner['offer_image'];
        }

        if($request->hasfile('deals_banner_image'))
        {

            $image = $request->file('deals_banner_image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/deals_banner_image/'.$image->getClientOriginalName();
            $path = public_path('/media/deals_banner_image/');
            $image->move($path, $filename);
            $input['deals_banner_image'] = $filename;
        }else
        {
          $input['deals_banner_image'] = $offerBanner['deals_banner_image'];
        }

        $offerBanner = $this->offerBannerRepository->update($input, $id);

        Flash::success('Offer Banner updated successfully.');

        return redirect(route('offerBanners.index'));
    }

    /**
     * Remove the specified Offer_banner from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            Flash::error('Offer Banner not found');

            return redirect(route('offerBanners.index'));
        }

        $this->offerBannerRepository->delete($id);

        Flash::success('Offer Banner deleted successfully.');

        return redirect(route('offerBanners.index'));
    }
}
