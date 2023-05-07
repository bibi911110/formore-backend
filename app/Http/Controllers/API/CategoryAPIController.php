<?php



namespace App\Http\Controllers\API;



use App\Http\Requests\API\CreateCategoryAPIRequest;

use App\Http\Requests\API\UpdateCategoryAPIRequest;

use App\Models\Category;

use App\Repositories\CategoryRepository;

use Illuminate\Http\Request;

use App\Http\Controllers\AppBaseController;

use App\Http\Resources\CategoryResource;

use Response;



/**

 * Class CategoryController

 * @package App\Http\Controllers\API

 */



class CategoryAPIController extends AppBaseController

{

    /** @var  CategoryRepository */

    private $categoryRepository;



    public function __construct(CategoryRepository $categoryRepo)

    {

        $this->categoryRepository = $categoryRepo;

    }



    /**

     * @param Request $request

     * @return Response

     *

     * @SWG\Get(

     *      path="/categories",

     *      summary="Get a listing of the Categories.",

     *      tags={"Category"},

     *      description="Get all Categories",

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

     *                  @SWG\Items(ref="#/definitions/Category")

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

       /* $categories = $this->categoryRepository->all(

            $request->except(['skip', 'limit']),

            $request->get('skip'),

            $request->get('limit')

        );



        return $this->sendResponse(CategoryResource::collection($categories), 'Categories retrieved successfully');*/



        $categories = Category::where('status',1)->orderBy('position','ASC')->get()->toArray();
        /*echo "<pre>";
        print_r($categories); exit;*/



        //$new = array()

        $i = 0;

        foreach ($categories as  $value) {

            if($i == 0)

            {

                $new[] = array('id' => '0',"name" =>'All');
                if($request->lang_id == 1)
                {
                    $new[] = array('id' => $value['id'],"name" =>$value['name'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }elseif ($request->lang_id == 2) {
                     $new[] = array('id' => $value['id'],"name" =>$value['cat_albanian'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }
                elseif ($request->lang_id == 3) {
                     $new[] = array('id' => $value['id'],"name" =>$value['cat_greek'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                } 
                elseif ($request->lang_id == 4) {
                     $new[] = array('id' => $value['id'],"name" =>$value['cat_italian'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }       

            }

            else

            {

                if($request->lang_id == 1)
                {
                    $new[] = array('id' => $value['id'],"name" =>$value['name'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }elseif ($request->lang_id == 2) {
                    $new[] = array('id' => $value['id'],"name" =>$value['cat_albanian'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }elseif ($request->lang_id == 3) {
                    $new[] = array('id' => $value['id'],"name" =>$value['cat_greek'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }elseif ($request->lang_id == 4) {
                    $new[] = array('id' => $value['id'],"name" =>$value['cat_italian'],"position" => $value['position'],"icon" => $value['icon'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);
                }
            }

            $i++;

            

        }

        

        if($new != ''){

            return response(['status'=>'200','Message'=>'Categories retrieved successfully.','categories' => $new]);

        }else{

            return response(['status'=>'401','Message'=>"Categories Not Found"]);

        }

    }

    public function sub_category_categorie_wise(Request $request)
    {
        $sub_category_data = [];
        if($request->cat_id[0] == 0){
           
           $sub_category = \App\Models\Sub_category::leftjoin('marketplace_logo','sub_category.id','marketplace_logo.sub_cat_id')
                                                   // ->whereIn('marketplace_logo.cat_id',$request->cat_id)
                                                    ->groupBy('sub_category.id')
                                                    ->select('sub_category.*','marketplace_logo.position')
                                                    ->orderBy('marketplace_logo.position','ASC')->get();
          

        }else{
            $sub_category = \App\Models\Sub_category::leftjoin('marketplace_logo','sub_category.id','marketplace_logo.sub_cat_id')
                                                    ->whereIn('sub_category.cat_id',$request->cat_id)
                                                    ->groupBy('sub_category.id')
                                                    ->select('sub_category.*','marketplace_logo.position')
                                                    ->orderBy('marketplace_logo.position','ASC')->get();

        }
        if($request->cat_id[0] == 0){
            foreach ($sub_category as $value) {
                   /* echo "<pre>";
                    print_r($value->id); exit;*/
                   if($request->lang_id == 1)
                   {
                    $name = $value->name;
                   }
                   else if($request->lang_id == 2)
                   {
                    $name = $value->subcat_albanian;

                   }
                   else if($request->lang_id == 3)
                   {
                    $name = $value->subcat_greek;
                   }
                   else if($request->lang_id == 4)
                   {
                    $name = $value->subcat_italian;
                   }
                   $sub_category_data[] =array('id' =>$value->id,
                                        'name' =>$name,
                                        'icon' =>$value->icon,
                                        'position' =>$value->position,
                                       );
                } 
        }else{
             foreach ($sub_category as $value) {
                   /* echo "<pre>";
                    print_r($value->id); exit;*/
                   if($request->lang_id == 1)
                   {
                    $name = $value->name;
                   }
                   else if($request->lang_id == 2)
                   {
                    $name = $value->subcat_albanian;

                   }
                   else if($request->lang_id == 3)
                   {
                    $name = $value->subcat_greek;
                   }
                   else if($request->lang_id == 4)
                   {
                    $name = $value->subcat_italian;
                   }
                   $sub_category_data[] =array('id' =>$value->id,
                                        'name' =>$name,
                                        'icon' =>$value->icon,
                                        'position' =>$value->position,
                                       );
                } 
        }              
        if($sub_category != ''){
            return response(['status'=>'200','Message'=>'Sub category retrieved successfully.','sub_category' =>$sub_category_data]);
        }else{
            return response(['status'=>'401','Message'=>"Sub category Not Found"]);
        } 
    }

   

     public function sub_category_business(Request $request)
    {

      //$sub_category_business = \App\Models\Sub_category::whereIn('id',$request->sub_cat_id)->get();

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 10000;

        $sub_category_business = \App\Models\Brand::leftjoin('users','brand.id','users.userDetailsId')
                    ->leftjoin('user_business_details','users.id','user_business_details.user_id')
                    ->leftjoin('bussiness_cat_subcat_mapping','brand.id','bussiness_cat_subcat_mapping.business_id')
                    ->where('users.user_type',3)
                    ->where('users.role_id',3)
                     ->select('brand.*','bussiness_cat_subcat_mapping.id as sub_cat_map_id','users.id as user_id','user_business_details.header_banner', \DB::raw("6371 * acos(cos(radians(" .  $latitude . "))
                     * cos(radians(brand.latitude)) 
                     * cos(radians(brand.longitude) - radians(" .$longitude. ")) 
                     + sin(radians(" .$latitude. ")) 
                     * sin(radians(brand.latitude))) AS distance"))
                     ->having('distance', '<', $radius)
                     ->orderBy("distance",'asc')
                     ->where('brand.status',1)
                     ->whereIn('bussiness_cat_subcat_mapping.sub_cat_id',$request->sub_cat_id)
                     ->groupBy('brand.id')
                     //->where('brand.country_id',$request->country_id)
                     ->whereNull('brand.deleted_at')
                     ->get();


        if($sub_category_business != ''){
            return response(['status'=>'200','Message'=>'Sub category business retrieved successfully.','sub_category_business' =>$sub_category_business]);
        }else{
            return response(['status'=>'401','Message'=>"Sub category Not Found"]);
        }
    }

    /**

     * @param CreateCategoryAPIRequest $request

     * @return Response

     *

     * @SWG\Post(

     *      path="/categories",

     *      summary="Store a newly created Category in storage",

     *      tags={"Category"},

     *      description="Store Category",

     *      produces={"application/json"},

     *      @SWG\Parameter(

     *          name="body",

     *          in="body",

     *          description="Category that should be stored",

     *          required=false,

     *          @SWG\Schema(ref="#/definitions/Category")

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

     *                  ref="#/definitions/Category"

     *              ),

     *              @SWG\Property(

     *                  property="message",

     *                  type="string"

     *              )

     *          )

     *      )

     * )

     */

    public function store(CreateCategoryAPIRequest $request)

    {

        $input = $request->all();



        $category = $this->categoryRepository->create($input);



        return $this->sendResponse(new CategoryResource($category), 'Category saved successfully');

    }



    /**

     * @param int $id

     * @return Response

     *

     * @SWG\Get(

     *      path="/categories/{id}",

     *      summary="Display the specified Category",

     *      tags={"Category"},

     *      description="Get Category",

     *      produces={"application/json"},

     *      @SWG\Parameter(

     *          name="id",

     *          description="id of Category",

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

     *                  ref="#/definitions/Category"

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

        /** @var Category $category */

        $category = $this->categoryRepository->find($id);



        if (empty($category)) {

            return $this->sendError('Category not found');

        }



        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully');

    }



    /**

     * @param int $id

     * @param UpdateCategoryAPIRequest $request

     * @return Response

     *

     * @SWG\Put(

     *      path="/categories/{id}",

     *      summary="Update the specified Category in storage",

     *      tags={"Category"},

     *      description="Update Category",

     *      produces={"application/json"},

     *      @SWG\Parameter(

     *          name="id",

     *          description="id of Category",

     *          type="integer",

     *          required=true,

     *          in="path"

     *      ),

     *      @SWG\Parameter(

     *          name="body",

     *          in="body",

     *          description="Category that should be updated",

     *          required=false,

     *          @SWG\Schema(ref="#/definitions/Category")

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

     *                  ref="#/definitions/Category"

     *              ),

     *              @SWG\Property(

     *                  property="message",

     *                  type="string"

     *              )

     *          )

     *      )

     * )

     */

    public function update($id, UpdateCategoryAPIRequest $request)

    {

        $input = $request->all();



        /** @var Category $category */

        $category = $this->categoryRepository->find($id);



        if (empty($category)) {

            return $this->sendError('Category not found');

        }



        $category = $this->categoryRepository->update($input, $id);



        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully');

    }



    /**

     * @param int $id

     * @return Response

     *

     * @SWG\Delete(

     *      path="/categories/{id}",

     *      summary="Remove the specified Category from storage",

     *      tags={"Category"},

     *      description="Delete Category",

     *      produces={"application/json"},

     *      @SWG\Parameter(

     *          name="id",

     *          description="id of Category",

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

        /** @var Category $category */

        $category = $this->categoryRepository->find($id);



        if (empty($category)) {

            return $this->sendError('Category not found');

        }



        $category->delete();



        return $this->sendSuccess('Category deleted successfully');

    }

}

