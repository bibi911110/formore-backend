<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrandAPIRequest;
use App\Http\Requests\API\UpdateBrandAPIRequest;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BrandResource;
use Response;

/**
 * Class BrandController
 * @package App\Http\Controllers\API
 */

class BrandAPIController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/brands",
     *      summary="Get a listing of the Brands.",
     *      tags={"Brand"},
     *      description="Get all Brands",
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
     *                  @SWG\Items(ref="#/definitions/Brand")
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
        /*$brands = $this->brandRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BrandResource::collection($brands), 'Brands retrieved successfully');*/

        $brands = Brand::where('brand.status',1)
                        ->leftjoin('category','brand.cat_id','category.id')
                        ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                         ->leftjoin('users','brand.id','users.userDetailsId')
                        ->where('users.user_type',3)
                        ->where('users.role_id',3)
                        ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon','users.id as user_id')
                        ->get();
        if($brands != ''){
            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }
    }

    public function brands_id_wise($id='')
    {
        $brands = Brand::where('brand.status',1)
                        //->where('brand.id',$id)
                        ->where('brand.type',2)
                        ->leftjoin('category','brand.cat_id','category.id')
                        ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                        ->leftjoin('users','brand.id','users.userDetailsId')
                        ->where('users.user_type',3)
                        ->where('users.role_id',3)
                        ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon','users.id as user_id')
                        ->get();
        if($brands != ''){
            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Brands Not Found"]);
        }
    }

   /*  public function business_deals_categorywise($cat_id)
    {
        $brands = Brand::where('brand.status',1)
                        //->where('brand.id',$id)
                         ->where('brand.type',1)
                        ->where('brand.cat_id',$cat_id)
                        ->leftjoin('category','brand.cat_id','category.id')
                        ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                        ->leftjoin('users','brand.id','users.userDetailsId')
                        ->where('users.user_type',3)
                        ->where('users.role_id',3)
                        ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon','users.id as user_id')
                        ->get();
        if($brands != ''){
            return response(['status'=>'200','Message'=>'Bussiness retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Bussiness Not Found"]);
        }
    }*/
         public function business_deals_categorywise(Request $request)
    {
         $latitude = $request->latitude;
         $longitude = $request->longitude;
         $radius = 10000;
         $brands =  \DB::table("brand")
                    ->leftjoin('category','brand.cat_id','category.id')
                    ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                    ->leftjoin('users','brand.id','users.userDetailsId')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                     ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('brand.cat_id',$request->cat_id)
                     ->whereNull('brand.deleted_at')
                     ->get();
        /*$brands = Brand::where('brand.status',1)
                        //->where('brand.id',$id)
                        ->where('brand.type',1)
                        ->where('brand.cat_id',$request->cat_id)
                        ->leftjoin('category','brand.cat_id','category.id')
                        ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                        ->leftjoin('users','brand.id','users.userDetailsId')
                        ->where('users.user_type',3)
                        ->where('users.role_id',3)
                        ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon','users.id as user_id')
                        ->get();*/
        if($brands != ''){
            return response(['status'=>'200','Message'=>'Bussiness retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Bussiness Not Found"]);
        }
    }

    public function informative_page(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 10000;
        $informative_page = [];
        $user_business_details = \App\Models\User_business_details::where('user_id',$request->user_id)->get();
        $social_icon = \App\Models\Social_icon::where('user_id',$request->user_id)->get();
        $web_link_banners = \App\Models\Web_link_banners::where('user_id',$request->user_id)->get();
        $offer_banner = \App\Models\Offer_banner::where('user_id',$request->user_id)->get();
        $purchase_options = \App\Models\Purchase_options::where('user_id',$request->user_id)->get();
        $about_us = \App\Models\About_us::where('user_id',$request->user_id)->get();
        $gallery = \App\Models\Gallery_master::where('user_id',$request->user_id)->get();
        $rating = \App\Models\Rating::where('buss_id',$request->user_id)->where('status',1)->get();
        $totalRating =\App\Models\Rating::where('buss_id',$request->user_id)->avg('rating_no');


        $brands =  \DB::table("brand")
                    ->leftjoin('category','brand.cat_id','category.id')
                    ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                    ->leftjoin('users','brand.id','users.userDetailsId')
                   // ->where('users.user_type',3)
                   // ->where('users.role_id',3)
                    ->where('users.id',$request->user_id)
                     ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->whereNull('brand.deleted_at')
                     ->get();

                        /*->leftjoin('category','brand.cat_id','category.id')
                        ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                        ->select('brand.*','category.name as cat_name','category.icon as cat_icon','sub_category.name as sub_name','sub_category.icon as sub_icon')*/
        $informative_page = array('user_business_details' => $user_business_details,
                                  'social_icon' => $social_icon,
                                  'web_link_banners' => $web_link_banners,
                                  'offer_banner' => $offer_banner,
                                  'purchase_options' => $purchase_options,
                                  'about_us' => $about_us,
                                  'gallery' => $gallery,
                                  'brands' => $brands,
                                  'rating' => $rating,
                                  'finel_rating' => $totalRating,

                              );
                        
        if($informative_page != ''){
            return response(['status'=>'200','Message'=>'Informative page retrieved successfully.','informative_page' => $informative_page]);
        }else{
            return response(['status'=>'401','Message'=>"Informative page Not Found"]);
        }

    }
    /**
     * @param CreateBrandAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/brands",
     *      summary="Store a newly created Brand in storage",
     *      tags={"Brand"},
     *      description="Store Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Brand that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Brand")
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
     *                  ref="#/definitions/Brand"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBrandAPIRequest $request)
    {
        $input = $request->all();

        $brand = $this->brandRepository->create($input);

        return $this->sendResponse(new BrandResource($brand), 'Brand saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/brands/{id}",
     *      summary="Display the specified Brand",
     *      tags={"Brand"},
     *      description="Get Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Brand",
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
     *                  ref="#/definitions/Brand"
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
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        return $this->sendResponse(new BrandResource($brand), 'Brand retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBrandAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/brands/{id}",
     *      summary="Update the specified Brand in storage",
     *      tags={"Brand"},
     *      description="Update Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Brand",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Brand that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Brand")
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
     *                  ref="#/definitions/Brand"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBrandAPIRequest $request)
    {
        $input = $request->all();

        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand = $this->brandRepository->update($input, $id);

        return $this->sendResponse(new BrandResource($brand), 'Brand updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/brands/{id}",
     *      summary="Remove the specified Brand from storage",
     *      tags={"Brand"},
     *      description="Delete Brand",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Brand",
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
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand->delete();

        return $this->sendSuccess('Brand deleted successfully');
    }
}
