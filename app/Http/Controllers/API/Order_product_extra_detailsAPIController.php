<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrder_product_extra_detailsAPIRequest;
use App\Http\Requests\API\UpdateOrder_product_extra_detailsAPIRequest;
use App\Models\Order_product_extra_details;
use App\Repositories\Order_product_extra_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Order_product_extra_detailsResource;
use Response;

/**
 * Class Order_product_extra_detailsController
 * @package App\Http\Controllers\API
 */

class Order_product_extra_detailsAPIController extends AppBaseController
{
    /** @var  Order_product_extra_detailsRepository */
    private $orderProductExtraDetailsRepository;

    public function __construct(Order_product_extra_detailsRepository $orderProductExtraDetailsRepo)
    {
        $this->orderProductExtraDetailsRepository = $orderProductExtraDetailsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProductExtraDetails",
     *      summary="Get a listing of the Order_product_extra_details.",
     *      tags={"Order_product_extra_details"},
     *      description="Get all Order_product_extra_details",
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
     *                  @SWG\Items(ref="#/definitions/Order_product_extra_details")
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
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Order_product_extra_detailsResource::collection($orderProductExtraDetails), 'Order Product Extra Details retrieved successfully');
    }
    public function order_extra_product_wise(Request $request)
    {
        $order_products = Order_product_extra_details::where('order_product_extra_details.product_id',$request->product_id)
                                            ->leftjoin('order_products','order_product_extra_details.product_id','order_products.id')
                                            ->leftjoin('users','order_product_extra_details.created_by','users.id')
                                            ->leftjoin('brand','users.userDetailsId','brand.id')
                                            ->leftjoin('currency','brand.currency','currency.id')
                                            ->select('order_product_extra_details.*','order_products.name as productName','currency.currency_code','currency.currency_name')
                                            ->get();


        if($order_products != ''){
            return response(['status'=>'200','Message'=>'Order products retrieved successfully.','order_products' => $order_products]);

        }else{
            return response(['status'=>'401','Message'=>"Order products Not Found"]);

        }
    }

    /**
     * @param CreateOrder_product_extra_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderProductExtraDetails",
     *      summary="Store a newly created Order_product_extra_details in storage",
     *      tags={"Order_product_extra_details"},
     *      description="Store Order_product_extra_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order_product_extra_details that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order_product_extra_details")
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
     *                  ref="#/definitions/Order_product_extra_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrder_product_extra_detailsAPIRequest $request)
    {
        $input = $request->all();

        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->create($input);

        return $this->sendResponse(new Order_product_extra_detailsResource($orderProductExtraDetails), 'Order Product Extra Details saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderProductExtraDetails/{id}",
     *      summary="Display the specified Order_product_extra_details",
     *      tags={"Order_product_extra_details"},
     *      description="Get Order_product_extra_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_product_extra_details",
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
     *                  ref="#/definitions/Order_product_extra_details"
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
        /** @var Order_product_extra_details $orderProductExtraDetails */
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            return $this->sendError('Order Product Extra Details not found');
        }

        return $this->sendResponse(new Order_product_extra_detailsResource($orderProductExtraDetails), 'Order Product Extra Details retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrder_product_extra_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderProductExtraDetails/{id}",
     *      summary="Update the specified Order_product_extra_details in storage",
     *      tags={"Order_product_extra_details"},
     *      description="Update Order_product_extra_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_product_extra_details",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Order_product_extra_details that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Order_product_extra_details")
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
     *                  ref="#/definitions/Order_product_extra_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrder_product_extra_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order_product_extra_details $orderProductExtraDetails */
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            return $this->sendError('Order Product Extra Details not found');
        }

        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->update($input, $id);

        return $this->sendResponse(new Order_product_extra_detailsResource($orderProductExtraDetails), 'Order_product_extra_details updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderProductExtraDetails/{id}",
     *      summary="Remove the specified Order_product_extra_details from storage",
     *      tags={"Order_product_extra_details"},
     *      description="Delete Order_product_extra_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Order_product_extra_details",
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
        /** @var Order_product_extra_details $orderProductExtraDetails */
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            return $this->sendError('Order Product Extra Details not found');
        }

        $orderProductExtraDetails->delete();

        return $this->sendSuccess('Order Product Extra Details deleted successfully');
    }
}
