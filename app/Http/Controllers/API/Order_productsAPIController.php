<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrder_productsAPIRequest;
use App\Http\Requests\API\UpdateOrder_productsAPIRequest;
use App\Models\Order_products;
use App\Repositories\Order_productsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Order_productsResource;
use Response;

/**
 * Class Order_productsController
 * @package App\Http\Controllers\API
 */

class Order_productsAPIController extends AppBaseController
{
    /** @var  Order_productsRepository */
    private $orderProductsRepository;

    public function __construct(Order_productsRepository $orderProductsRepo)
    {
        $this->orderProductsRepository = $orderProductsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProducts",
     *      summary="Get a listing of the Order_products.",
     *      tags={"Order_products"},
     *      description="Get all Order_products",
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
     *                  @SWG\Items(ref="#/definitions/Order_products")
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
        $orderProducts = $this->orderProductsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Order_productsResource::collection($orderProducts), 'Order Products retrieved successfully');
    }

    public function order_products_business_wise(Request $request)
    {

        if(!empty($request['cat_id']) && $request['cat_id'] != '')
        {
            $order_products = Order_products::where('order_products.created_by',$request->business_id)
                                            ->where('order_products.cat_id',$request->cat_id)
                                            ->leftjoin('order_categories','order_products.cat_id','order_categories.id')
                                            ->leftjoin('users','order_products.created_by','users.id')
                                            ->leftjoin('brand','users.userDetailsId','brand.id')
                                            ->leftjoin('currency','brand.currency','currency.id')
                                            ->select('order_products.*','order_categories.name as catName','currency.currency_code','currency.currency_name')
                                            ->get();
            $count = 0;
            foreach ($order_products as $value) {

             $cart_extra_details = \App\Models\Order_product_extra_details::leftjoin('order_products','order_product_extra_details.product_id','order_products.id')
                                                    ->where('order_product_extra_details.product_id',$value->id)
                                                    ->select('order_product_extra_details.*','order_products.name as product_name')
                                                   ->get();

                
            $order_products[$count] = $value;
            $order_products[$count]['extra_details'] = $cart_extra_details;
           // $orders_details_view[$count]['product'] = $product;
            $count++;


            }
        }else{

            $order_products = Order_products::where('order_products.created_by',$request->business_id)
                                            //->where('order_products.cat_id',$request->cat_id)
                                            ->leftjoin('order_categories','order_products.cat_id','order_categories.id')
                                            ->leftjoin('users','order_products.created_by','users.id')
                                            ->leftjoin('brand','users.userDetailsId','brand.id')
                                            ->leftjoin('currency','brand.currency','currency.id')
                                            ->select('order_products.*','order_categories.name as catName','currency.currency_code','currency.currency_name')
                                          //  ->select('order_products.*','order_categories.name as catName')
                                            ->get();

        }
        $count = 0;
        foreach ($order_products as $value) {

         $cart_extra_details = \App\Models\Order_product_extra_details::leftjoin('order_products','order_product_extra_details.product_id','order_products.id')
                                                ->where('order_product_extra_details.product_id',$value->id)
                                                ->select('order_product_extra_details.*','order_products.name as product_name')
                                               ->get();

            
        $order_products[$count] = $value;
        $order_products[$count]['extra_details'] = $cart_extra_details;
       // $orders_details_view[$count]['product'] = $product;
        $count++;


        }


        if($order_products != ''){
            return response(['status'=>'200','Message'=>'Order products retrieved successfully.','order_products' => $order_products]);

        }else{
            return response(['status'=>'401','Message'=>"Order products Not Found"]);

        }
    }

    /**
     * @param CreateOrder_productsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderProducts",
     *      summary="Store a newly created Order_products in storage",
     *      tags={"Order_products"},
     *      description="Store Order_products",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order_products that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order_products")
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
     *                  ref="#/definitions/Order_products"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrder_productsAPIRequest $request)
    {
        $input = $request->all();

        $orderProducts = $this->orderProductsRepository->create($input);

        return $this->sendResponse(new Order_productsResource($orderProducts), 'Order Products saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProducts/{id}",
     *      summary="Display the specified Order_products",
     *      tags={"Order_products"},
     *      description="Get Order_products",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_products",
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
     *                  ref="#/definitions/Order_products"
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
        /** @var Order_products $orderProducts */
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            return $this->sendError('Order Products not found');
        }

        return $this->sendResponse(new Order_productsResource($orderProducts), 'Order Products retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrder_productsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderProducts/{id}",
     *      summary="Update the specified Order_products in storage",
     *      tags={"Order_products"},
     *      description="Update Order_products",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_products",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order_products that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order_products")
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
     *                  ref="#/definitions/Order_products"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrder_productsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order_products $orderProducts */
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            return $this->sendError('Order Products not found');
        }

        $orderProducts = $this->orderProductsRepository->update($input, $id);

        return $this->sendResponse(new Order_productsResource($orderProducts), 'Order_products updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderProducts/{id}",
     *      summary="Remove the specified Order_products from storage",
     *      tags={"Order_products"},
     *      description="Delete Order_products",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_products",
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
        /** @var Order_products $orderProducts */
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            return $this->sendError('Order Products not found');
        }

        $orderProducts->delete();

        return $this->sendSuccess('Order Products deleted successfully');
    }
}
