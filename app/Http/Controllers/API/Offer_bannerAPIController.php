<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOffer_bannerAPIRequest;
use App\Http\Requests\API\UpdateOffer_bannerAPIRequest;
use App\Models\Offer_banner;
use App\Models\Brand;
use App\Repositories\Offer_bannerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Offer_bannerResource;
use Response;

/**
 * Class Offer_bannerController
 * @package App\Http\Controllers\API
 */

class Offer_bannerAPIController extends AppBaseController
{
    /** @var  Offer_bannerRepository */
    private $offerBannerRepository;

    public function __construct(Offer_bannerRepository $offerBannerRepo)
    {
        $this->offerBannerRepository = $offerBannerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/offerBanners",
     *      summary="Get a listing of the Offer_banners.",
     *      tags={"Offer_banner"},
     *      description="Get all Offer_banners",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Offer_banner")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $offerBanners = $this->offerBannerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Offer_bannerResource::collection($offerBanners), 'Offer Banners retrieved successfully');
    }

    /**
     * @param CreateOffer_bannerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/offerBanners",
     *      summary="Store a newly created Offer_banner in storage",
     *      tags={"Offer_banner"},
     *      description="Store Offer_banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Offer_banner that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Offer_banner")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Offer_banner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOffer_bannerAPIRequest $request)
    {
        $input = $request->all();

        $offerBanner = $this->offerBannerRepository->create($input);

        return $this->sendResponse(new Offer_bannerResource($offerBanner), 'Offer Banner saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/offerBanners/{id}",
     *      summary="Display the specified Offer_banner",
     *      tags={"Offer_banner"},
     *      description="Get Offer_banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Offer_banner",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Offer_banner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Offer_banner $offerBanner */
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            return $this->sendError('Offer Banner not found');
        }

        return $this->sendResponse(new Offer_bannerResource($offerBanner), 'Offer Banner retrieved successfully');
    }
    

     public function offer_banners_buss_wise(Request $request)

    {

         $latitude = $request->latitude;
         $longitude = $request->longitude;
         $radius = 10000;
         if($request->cat_id == 0)
         {
            /*$brands = Brand::leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')
                    ->leftjoin('users','brand.id','users.userDetailsId')
                    ->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                    //->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                    ->groupBy('offer_banner.cat_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                    ->select('brand.*','category.name as catName','offer_banner.offer_image','offer_banner.deals_banner_image','offer_banner.title_for_deals','offer_banner.description_eng','offer_banner.description_italian','offer_banner.description_albanian','offer_banner.cat_id as catid','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('brand.type',1)                    
                     ->whereNull('brand.deleted_at')
                     ->get();*/
            $brands = Offer_banner::leftjoin('users','offer_banner.user_id','users.id')
                    ->leftjoin('category','offer_banner.cat_id','category.id')
                    ->leftjoin('brand','users.userDetailsId','brand.id')
                    //->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                    //->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                    //->groupBy('offer_banner.cat_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                    ->select('brand.*','category.name as catName','offer_banner.offer_image','offer_banner.deals_banner_image','offer_banner.title_for_deals','offer_banner.description_eng','offer_banner.description_italian','offer_banner.description_albanian','offer_banner.cat_id as catid','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('brand.type',1)                    
                     ->whereNull('brand.deleted_at')
                     ->get();

                     $brands_data = $brands;

                $count = 0;

                foreach ($brands_data as $value) {


                    $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)
                                                     ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')
                                                     ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')
                                                     ->groupBy('category.id')
                                                     ->get()->toArray();


                    $sub_category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                     ->leftjoin('sub_category','bussiness_cat_subcat_mapping.sub_cat_id','sub_category.id')

                                                     ->select('sub_category.id as subCatId','sub_category.name as sub_name','sub_category.icon as sub_icon')

                                                     ->get();

                    



                    $brands_data[$count] = $value;

                    $brands_data[$count]['category'] = $category;

                    $brands_data[$count]['sub_category'] = $sub_category;



                    $count++;

                }

        }

        else

        {

            /*$brands = Brand::leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')
                    ->leftjoin('users','bussiness_cat_subcat_mapping.id','users.userDetailsId')
                    ->leftjoin('offer_banner','brand.cat_id','offer_banner.cat_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                    ->groupBy('offer_banner.cat_id')
                    ->select('brand.*','category.name as catName','offer_banner.offer_image','offer_banner.deals_banner_image','offer_banner.title_for_deals','offer_banner.description_eng','offer_banner.description_italian','offer_banner.description_albanian','offer_banner.cat_id as catid','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('brand.type',1)
                     ->whereNull('brand.deleted_at')
                     ->where('offer_banner.cat_id',$request->cat_id)
                     //->where('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)

                     ->get();*/

            $brands = Offer_banner::leftjoin('users','offer_banner.user_id','users.id')
                    ->leftjoin('category','offer_banner.cat_id','category.id')
                    ->leftjoin('brand','users.userDetailsId','brand.id')
                    //->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                    //->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                   /* ->where('users.user_type',3)
                    ->where('users.role_id',3)*/
                    ->select('brand.*','category.name as catName','offer_banner.offer_image','offer_banner.deals_banner_image','offer_banner.title_for_deals','offer_banner.description_eng','offer_banner.description_italian','offer_banner.description_albanian','offer_banner.cat_id as catid','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('brand.type',1) 
                     ->where('offer_banner.cat_id',$request->cat_id)                   
                     //->groupBy('offer_banner.cat_id')
                     ->whereNull('brand.deleted_at')
                     ->get();

    

                $brands_data = $brands;
                /*echo "<pre>";
                print_r($brands_data); exit;*/          



                $count = 0;

                foreach ($brands_data as $value) {

                    $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                     ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')

                                                     ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')

                                                     ->groupBy('category.id')

                                                     ->get()->toArray();





                    $sub_category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                     ->leftjoin('sub_category','bussiness_cat_subcat_mapping.sub_cat_id','sub_category.id')

                                                     ->select('sub_category.id as subCatId','sub_category.name as sub_name','sub_category.icon as sub_icon')

                                                     ->get();

                    



                    $brands_data[$count] = $value;

                    $brands_data[$count]['category'] = $category;

                    $brands_data[$count]['sub_category'] = $sub_category;



                    $count++;

                }

        }

        if($brands != ''){

            return response(['status'=>'200','Message'=>'Bussiness retrieved successfully.','brands' => $brands]);

        }else{

            return response(['status'=>'401','Message'=>"Bussiness Not Found"]);

        }

    }

    public function offer_banners_brand_wise(Request $request)
    {

         $latitude = $request->latitude;
         $longitude = $request->longitude;
         $radius = 10000;
         $brand_id = \App\User::where('userDetailsId',$request->brand_id)->where('role_id','3')->first();
         /*echo "<pre>";
         print_r($brand_id->id); exit;*/
         $brands = Brand::leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->leftjoin('users','brand.id','users.userDetailsId')
                    ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')
                    ->leftjoin('offer_banner','bussiness_cat_subcat_mapping.cat_id','offer_banner.cat_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                    ->select('brand.*','category.name as catName','offer_banner.offer_image','offer_banner.deals_banner_image','offer_banner.title_for_deals','offer_banner.description_eng','offer_banner.description_italian','offer_banner.description_albanian','offer_banner.cat_id as catid','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('brand.type',2)
                     ->whereNull('brand.deleted_at')
                     ->where('brand.id',$request->brand_id)
                     ->where('offer_banner.user_id',$brand_id->id)
                     ->groupBy('offer_banner.id')
                     ->get();

    

                $brands_data = $brands;
                $count = 0;

                foreach ($brands_data as $value) {

                    $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                     ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')

                                                     ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')

                                                     ->groupBy('category.id')

                                                     ->get()->toArray();





                    $sub_category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                     ->leftjoin('sub_category','bussiness_cat_subcat_mapping.sub_cat_id','sub_category.id')

                                                     ->select('sub_category.id as subCatId','sub_category.name as sub_name','sub_category.icon as sub_icon')

                                                     ->get();

                    



                    $brands_data[$count] = $value;

                    $brands_data[$count]['category'] = $category;

                    $brands_data[$count]['sub_category'] = $sub_category;



                    $count++;

                }

        

        if($brands != ''){

            return response(['status'=>'200','Message'=>'Brand retrieved successfully.','brands' => $brands]);

        }else{

            return response(['status'=>'401','Message'=>"Brand Not Found"]);

        }

    }

    
    /**
     * @param int $id
     * @param UpdateOffer_bannerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/offerBanners/{id}",
     *      summary="Update the specified Offer_banner in storage",
     *      tags={"Offer_banner"},
     *      description="Update Offer_banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Offer_banner",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Offer_banner that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Offer_banner")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Offer_banner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOffer_bannerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Offer_banner $offerBanner */
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            return $this->sendError('Offer Banner not found');
        }

        $offerBanner = $this->offerBannerRepository->update($input, $id);

        return $this->sendResponse(new Offer_bannerResource($offerBanner), 'Offer_banner updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/offerBanners/{id}",
     *      summary="Remove the specified Offer_banner from storage",
     *      tags={"Offer_banner"},
     *      description="Delete Offer_banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Offer_banner",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Offer_banner $offerBanner */
        $offerBanner = $this->offerBannerRepository->find($id);

        if (empty($offerBanner)) {
            return $this->sendError('Offer Banner not found');
        }

        $offerBanner->delete();

        return $this->sendSuccess('Offer Banner deleted successfully');
    }
}
