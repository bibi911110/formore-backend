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

use DB;

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

        $brands = Brand::where('brand.status',1)

                ->leftjoin('users','brand.id','users.userDetailsId')
                ->where('brand.type',2)

                ->where('users.user_type',3)

                ->where('users.role_id',3)

                ->select('brand.*','users.id as user_id')

                ->get();

        

        $brands_data = $brands;



        

            

            $count = 0;

            foreach ($brands_data as $value) {

                $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                 ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')

                                                 ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')

                                                 ->groupBy('category.id')

                                                 ->get();



                

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

            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','brands' => $brands]);

        }else{

            return response(['status'=>'401','Message'=>"Brands Not Found"]);

        }

    }

    public function order_brand(Request $request)
    {

     /*$brands = Brand::where('brand.status',1)

                ->leftjoin('member_orders','brand.id','member_orders.created_by')
                ->leftjoin('users','member_orders.created_by','users.id')
                ->where('member_orders.member_id',$request->user_id)
                ->where('users.user_type',3)
                ->where('users.role_id',3)
                ->select('brand.*','users.id as user_id')
                ->get();
*/

     $brands = \App\Models\Member_orders::leftjoin('users','member_orders.created_by','users.id')
                                        ->leftjoin('brand','users.userDetailsId','brand.id')
                                        ->where('member_orders.member_id',$request->user_id)
                                        ->where('users.user_type',3)
                                        ->where('users.role_id',3)
                                        ->groupBy('brand.id')
                                        ->select('brand.*','users.id as user_id','member_orders.id as m_id')
                                        ->get();

        
     $brands_data = $brands;       

            

            $count = 0;

            foreach ($brands_data as $value) {

                $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                 ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')

                                                 ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')

                                                 ->groupBy('category.id')

                                                 ->get();



                

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

            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','brands' => $brands]);

        }else{

            return response(['status'=>'401','Message'=>"Brands Not Found"]);

        }

    }


    public function brands_id_wise($id='')

    {

        $brands = Brand::where('brand.status',1)

                ->where('brand.type',2)

                ->leftjoin('users','brand.id','users.userDetailsId')

                ->where('users.user_type',3)

                ->where('users.role_id',3)

                ->select('brand.*','users.id as user_id')

                ->get();

        

        $brands_data = $brands;



        

            

            $count = 0;

            foreach ($brands_data as $value) {

                $category = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.business_id',$value->id)

                                                 ->leftjoin('category','bussiness_cat_subcat_mapping.cat_id','category.id')

                                                 ->select('category.id as catId','category.name as cat_name','category.icon as cat_icon')

                                                 ->groupBy('category.id')

                                                 ->get();



                

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

            return response(['status'=>'200','Message'=>'Brands retrieved successfully.','brands' => $brands]);

        }else{

            return response(['status'=>'401','Message'=>"Brands Not Found"]);

        }

    }



     public function business_map_wise(Request $request)
    {

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 10000;

        if($request->cat_id == 0)
        {
            $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')
                     ->leftjoin('user_business_details','users.id','user_business_details.user_id')
                      ->leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                     ->select('brand.*','users.id as user_id','user_business_details.header_banner', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     //->where('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)
                    // ->where('brand.country_id',$request->country_id)
                     ->whereNull('brand.deleted_at')
                     ->groupBy('brand.id')
                     ->get();

        }else{

            $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')
                     ->leftjoin('user_business_details','users.id','user_business_details.user_id')
                      ->leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                     ->select('brand.*','users.id as user_id','user_business_details.header_banner', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->where('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)
                    // ->where('brand.country_id',$request->country_id)
                     ->whereNull('brand.deleted_at')
                     ->groupBy('brand.id')
                     ->get();

        }

        

        if($brands != ''){
            return response(['status'=>'200','Message'=>'Bussiness retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Bussiness Not Found"]);

        }

    }

    public function category_search_business(Request$request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 10000;

        if($request->cat_id[0] != 0)
        {
            $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')
                         ->leftjoin('user_business_details','users.id','user_business_details.user_id')
                        ->leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                      //  ->leftjoin('country_business_position','brand.id','country_business_position.business_id')
                        ->where('users.user_type',3)
                        ->where('users.role_id',3)
                        ->select('brand.*','users.id as user_id','user_business_details.header_banner', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                         * cos(radians(brand.latitude)) 
                         * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                         + sin(radians(" .$latitude. ")) 
                         * sin(radians(brand.latitude))) AS distance"))
                         ->having('distance', '<', $radius)
                        // ->orderBy("country_business_position.position",'asc')
                         ->orderBy("distance",'asc')
                         ->where('brand.status',1)
                         ->whereIn('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)
                          ->where('brand.country_id',$request->country_id)
                         //->where('brand.country_id',$request->country_id)
                         ->whereNull('brand.deleted_at')
                         ->groupBy('brand.id')
                         ->get();
        }else{
            //echo "string"; exit;

            $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')
                         ->leftjoin('user_business_details','users.id','user_business_details.user_id')
                        ->leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                      //  ->leftjoin('country_business_position','brand.id','country_business_position.business_id')
                        ->where('users.user_type',3)
                        ->where('users.role_id',3)
                         ->select('brand.*','users.id as user_id','user_business_details.header_banner', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                         * cos(radians(brand.latitude)) 
                         * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                         + sin(radians(" .$latitude. ")) 
                         * sin(radians(brand.latitude))) AS distance"))
                         ->having('distance', '<', $radius)
                        // ->orderBy("country_business_position.position",'asc')
                         ->orderBy("distance",'asc')
                         ->where('brand.status',1)
                        // ->whereIn('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)
                          ->where('brand.country_id',$request->country_id)
                         //->where('brand.country_id',$request->country_id)
                         ->whereNull('brand.deleted_at')
                         ->groupBy('brand.id')
                         ->get();
        }


        if($brands != ''){
            return response(['status'=>'200','Message'=>'Bussiness retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Bussiness Not Found"]);

        }
        // code...
    }


public function country_wise_business_position(Request$request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 10000;

        $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')
                     ->leftjoin('user_business_details','users.id','user_business_details.user_id')
                    ->leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->leftjoin('country_business_position','brand.id','country_business_position.business_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                     ->select('brand.*','users.id as user_id','user_business_details.header_banner','country_business_position.position', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("country_business_position.position",'asc')
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                    // ->whereIn('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)
                      //->where('brand.country_id',$request->country_id)
                      ->where('country_business_position.country_id',$request->country_id)
                     //->where('brand.country_id',$request->country_id)
                     ->whereNull('brand.deleted_at')
                     ->groupBy('brand.id')
                     ->get();


        if($brands != ''){
            return response(['status'=>'200','Message'=>'Bussiness retrieved successfully.','brands' => $brands]);
        }else{
            return response(['status'=>'401','Message'=>"Bussiness Not Found"]);

        }
        // code...
    }
    
    public function business_deals_categorywise(Request $request)

    {

         $latitude = $request->latitude;

         $longitude = $request->longitude;

         $radius = 10000;



         if($request->cat_id == 0)

         {

            $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')

                    ->where('users.user_type',3)

                    ->where('users.role_id',3)

                     ->select('brand.*','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))

                     * cos(radians(brand.latitude)) 

                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 

                     + sin(radians(" .$latitude. ")) 

                     * sin(radians(brand.latitude))) AS distance"))

                     ->having('distance', '<', $radius)

                     ->orderBy("distance",'asc')

                     ->where('brand.status',1)
                      ->where('brand.type',1)
                     // ->where('brand.cat_id',$request->cat_id)

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

            $brands = Brand::leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')

                    ->leftjoin('users','brand.id','users.userDetailsId')

                    ->where('users.user_type',3)

                    ->where('users.role_id',3)

                     ->select('brand.*','bussiness_cat_subcat_mapping.cat_id','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))

                     * cos(radians(brand.latitude)) 

                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 

                     + sin(radians(" .$latitude. ")) 

                     * sin(radians(brand.latitude))) AS distance"))

                     ->having('distance', '<', $radius)

                     ->orderBy("distance",'asc')

                     ->where('brand.status',1)

                    ->where('bussiness_cat_subcat_mapping.cat_id',$request->cat_id)
                     ->where('brand.type',1)
                     ->whereNull('brand.deleted_at')

                     ->groupBy('brand.id')

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

        $buss_id = \App\User::where('id',$request->user_id)->select('userDetailsId')->first();
        $user_business_details_1 = \App\Models\User_business_details::where('user_business_details.user_id',$request->user_id)
                                    ->leftjoin('brand','user_business_details.user_id','brand.id')
                                    ->select('user_business_details.*','brand.name as business_name')
                                    ->get();
        $user_points = \App\User::where('id',$request->current_user_id)->first();

        $buss_point_s = \App\Models\My_rewards::where('my_rewards.buss_id',$buss_id->userDetailsId)->where('user_id',$request->current_user_id)->sum('point_per_stamp');

        $buss_point = \App\Models\Bussiness_wise_stamp_point::where('business_id',$buss_id->userDetailsId)
                                                ->where('user_id',$request->current_user_id)
                                                ->select('bussiness_wise_stamp_point.total_stamp','bussiness_wise_stamp_point.total_point','bussiness_wise_stamp_point.business_id')
                                                ->first();

         $brandName = \App\Models\Brand::where('id',@$buss_point->business_id)->first();
       // echo $buss_point; exit;
       /* echo "<pre>";
        print_r($buss_point_s); exit;*/

        $user_business_details = [];
        foreach ($user_business_details_1 as  $value) {
            if($buss_point->total_point != 0)
            {
              $all_point = @$buss_point->total_point; 
            }else{
                $all_point = @$buss_point_s;
            }
            $user_business_details[] = array("id" => $value->id,
                                             "user_id" => $value->user_id,
                                             "header_banner" => $value->header_banner,
                                             "business_name" => $brandName->name,
                                             "map_link" => $value->map_link,
                                             //"user_available_points" => $user_points->point,
                                             //"user_available_points" => $buss_point,
                                             //"user_available_stamp" => @$buss_point->total_point,
                                             "user_available_points" => @$all_point,
                                             "e_shop_banner" => $value->e_shop_banner,
                                             "booking_banner" => $value->booking_banner,
                                             "logo" => $value->logo,
                                             "created_at" => $value->created_at,
                                             "updated_at" => $value->updated_at,
                                             "deleted_at" => $value->deleted_at,
                                            );

        }

        $social_icon = \App\Models\Social_icon::where('user_id',$request->user_id)->get();

        $web_link_banners = \App\Models\Web_link_banners::where('user_id',$request->user_id)->get();

        $offer_banner = \App\Models\Offer_banner::where('user_id',$request->user_id)->get();

        $purchase_options = \App\Models\Purchase_options::where('user_id',$request->user_id)
                                        ->where('v_code','!=','')
                                        ->where('code_status',NULL)
                                        ->get();

        $about_us = \App\Models\About_us::where('user_id',$request->user_id)->get();

        $gallery = \App\Models\Gallery_master::where('user_id',$request->user_id)->get();

        $rating = \App\Models\Rating::where('buss_id',$request->user_id)->where('status',1)->get();

        $totalRating =\App\Models\Rating::where('buss_id',$request->user_id)->avg('rating_no');
        $loyalty_banner  =\App\Models\Loyalty_banner_master::where('user_id',$request->user_id)->get();





        $brands = Brand::leftjoin('users','brand.id','users.userDetailsId')

                    //->where('users.user_type',3)

                    //->where('users.role_id',3)

                    ->where('users.id',$request->user_id)

                     ->select('brand.*','users.id as user_id', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))

                     * cos(radians(brand.latitude)) 

                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 

                     + sin(radians(" .$latitude. ")) 

                     * sin(radians(brand.latitude))) AS distance"))

                     ->having('distance', '<', $radius)

                     ->orderBy("distance",'asc')

                     ->where('brand.status',1)

                     // ->where('brand.cat_id',$request->cat_id)

                     //->whereNull('brand.deleted_at')

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
                                  'loyalty_banner' => $loyalty_banner,



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

