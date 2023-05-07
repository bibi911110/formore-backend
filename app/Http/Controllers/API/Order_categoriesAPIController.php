<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrder_categoriesAPIRequest;
use App\Http\Requests\API\UpdateOrder_categoriesAPIRequest;
use App\Models\Order_categories;
use App\Repositories\Order_categoriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Order_categoriesResource;
use Response;

/**
 * Class Order_categoriesController
 * @package App\Http\Controllers\API
 */

class Order_categoriesAPIController extends AppBaseController
{
    /** @var  Order_categoriesRepository */
    private $orderCategoriesRepository;

    public function __construct(Order_categoriesRepository $orderCategoriesRepo)
    {
        $this->orderCategoriesRepository = $orderCategoriesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderCategories",
     *      summary="Get a listing of the Order_categories.",
     *      tags={"Order_categories"},
     *      description="Get all Order_categories",
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
     *                  @SWG\Items(ref="#/definitions/Order_categories")
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
        $orderCategories = $this->orderCategoriesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Order_categoriesResource::collection($orderCategories), 'Order Categories retrieved successfully');
    }

    public function order_categories_business_wise(Request $request)
    {
       
        $categories = Order_categories::where('status',1)->where('created_by',$request->business_id)->groupBy('id')->get()->toArray();

       $new[] = array('id' => '0',"name" =>'All');
       foreach ($categories as  $value) {

                $new[] = array('id' => $value['id'],"name" =>$value['name'],"created_by" => $value['created_by'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);      
        

        }


        if($new != ''){
            return response(['status'=>'200','Message'=>'Categories retrieved successfully.','categories' => $new]);

        }else{
            return response(['status'=>'401','Message'=>"Categories Not Found"]);

        }
    }

    /**
     * @param CreateOrder_categoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderCategories",
     *      summary="Store a newly created Order_categories in storage",
     *      tags={"Order_categories"},
     *      description="Store Order_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order_categories that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order_categories")
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
     *                  ref="#/definitions/Order_categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrder_categoriesAPIRequest $request)
    {
        $input = $request->all();

        $orderCategories = $this->orderCategoriesRepository->create($input);

        return $this->sendResponse(new Order_categoriesResource($orderCategories), 'Order Categories saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderCategories/{id}",
     *      summary="Display the specified Order_categories",
     *      tags={"Order_categories"},
     *      description="Get Order_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_categories",
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
     *                  ref="#/definitions/Order_categories"
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
        /** @var Order_categories $orderCategories */
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            return $this->sendError('Order Categories not found');
        }

        return $this->sendResponse(new Order_categoriesResource($orderCategories), 'Order Categories retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrder_categoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderCategories/{id}",
     *      summary="Update the specified Order_categories in storage",
     *      tags={"Order_categories"},
     *      description="Update Order_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_categories",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order_categories that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order_categories")
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
     *                  ref="#/definitions/Order_categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrder_categoriesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order_categories $orderCategories */
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            return $this->sendError('Order Categories not found');
        }

        $orderCategories = $this->orderCategoriesRepository->update($input, $id);

        return $this->sendResponse(new Order_categoriesResource($orderCategories), 'Order_categories updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderCategories/{id}",
     *      summary="Remove the specified Order_categories from storage",
     *      tags={"Order_categories"},
     *      description="Delete Order_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_categories",
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
        /** @var Order_categories $orderCategories */
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            return $this->sendError('Order Categories not found');
        }

        $orderCategories->delete();

        return $this->sendSuccess('Order Categories deleted successfully');
    }
}
