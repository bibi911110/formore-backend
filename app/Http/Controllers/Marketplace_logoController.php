<?php

namespace App\Http\Controllers;

use App\DataTables\Marketplace_logoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMarketplace_logoRequest;
use App\Http\Requests\UpdateMarketplace_logoRequest;
use App\Repositories\Marketplace_logoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Marketplace_logoController extends AppBaseController
{
    /** @var  Marketplace_logoRepository */
    private $marketplaceLogoRepository;

    public function __construct(Marketplace_logoRepository $marketplaceLogoRepo)
    {
        $this->marketplaceLogoRepository = $marketplaceLogoRepo;

        $this->middleware('permission:marketplace_logos-index|marketplace_logos-create|marketplace_logos-edit|marketplace_logos-delete', ['only' => ['index','store']]);
        $this->middleware('permission:marketplace_logos-create', ['only' => ['create','store']]);
        $this->middleware('permission:marketplace_logos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:marketplace_logos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Marketplace_logo.
     *
     * @param Marketplace_logoDataTable $marketplaceLogoDataTable
     * @return Response
     */
    public function index(Marketplace_logoDataTable $marketplaceLogoDataTable)
    {
        $data = \App\Models\Marketplace_logo::orderBy('marketplace_logo.position','ASC')
                                    ->leftjoin('brand','marketplace_logo.business_id','brand.id')
                                    ->leftjoin('country','marketplace_logo.country_id','country.id')
                                    ->leftjoin('category','marketplace_logo.cat_id','category.id')
                                    ->leftjoin('sub_category','marketplace_logo.sub_cat_id','sub_category.id')
                                    ->select('marketplace_logo.*','brand.name as brnadName','country.country_name','category.name as catName','sub_category.name as subcatName')
                                    //->get();                                    
                                    ->paginate(20);
      
        return view('marketplace_logos.index',compact('data'));
        //return $marketplaceLogoDataTable->render('marketplace_logos.index');
    }

    /**
     * Show the form for creating a new Marketplace_logo.
     *
     * @return Response
     */
    public function create()
    {
        $country = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        $category = \App\Models\Category::where('status','1')->pluck('name','id');
        $sub_category = \App\Models\Sub_category::where('status','1')->pluck('name','id');
        return view('marketplace_logos.create',compact('brands','country','category','sub_category'));
    }

    /**
     * Store a newly created Marketplace_logo in storage.
     *
     * @param CreateMarketplace_logoRequest $request
     *
     * @return Response
     */
    public function store(CreateMarketplace_logoRequest $request)
    {
        $check_position = \App\Models\Marketplace_logo::where('position',$request->position)->first();
        if(empty($check_position)){
            $input = $request->all();

            $marketplaceLogo = $this->marketplaceLogoRepository->create($input);

            Flash::success('Marketplace Logo saved successfully.');

            return redirect(route('marketplaceLogos.index'));
         }else
        {
             Flash::error('Marketplace Logo position already assigned.');

            return redirect(route('marketplaceLogos.index'));
        }
    }

    /**
     * Display the specified Marketplace_logo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            Flash::error('Marketplace Logo not found');

            return redirect(route('marketplaceLogos.index'));
        }

        return view('marketplace_logos.show')->with('marketplaceLogo', $marketplaceLogo);
    }

    /**
     * Show the form for editing the specified Marketplace_logo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            Flash::error('Marketplace Logo not found');

            return redirect(route('marketplaceLogos.index'));
        }
        $country = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        $category = \App\Models\Category::where('status','1')->pluck('name','id');
        $sub_category = \App\Models\Sub_category::where('status','1')->pluck('name','id');
        return view('marketplace_logos.edit',compact('brands','country','category','sub_category'))->with('marketplaceLogo', $marketplaceLogo);
    }

    /**
     * Update the specified Marketplace_logo in storage.
     *
     * @param  int              $id
     * @param UpdateMarketplace_logoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMarketplace_logoRequest $request)
    {
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            Flash::error('Marketplace Logo not found');

            return redirect(route('marketplaceLogos.index'));
        }

        $marketplaceLogo = $this->marketplaceLogoRepository->update($request->all(), $id);

        Flash::success('Marketplace Logo updated successfully.');

        return redirect(route('marketplaceLogos.index'));
    }

    /**
     * Remove the specified Marketplace_logo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            Flash::error('Marketplace Logo not found');

            return redirect(route('marketplaceLogos.index'));
        }

        $this->marketplaceLogoRepository->delete($id);

        Flash::success('Marketplace Logo deleted successfully.');

        return redirect(route('marketplaceLogos.index'));
    }
}
