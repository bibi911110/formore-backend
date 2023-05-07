<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCoupon_master_orderAPIRequest;
use App\Http\Requests\API\UpdateCoupon_master_orderAPIRequest;
use App\Models\Coupon_master_order;
use App\Repositories\Coupon_master_orderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Coupon_master_orderResource;
use Response;

/**
 * Class Coupon_master_orderController
 * @package App\Http\Controllers\API
 */

class Coupon_master_orderAPIController extends AppBaseController
{
    /** @var  Coupon_master_orderRepository */
    private $couponMasterOrderRepository;

    public function __construct(Coupon_master_orderRepository $couponMasterOrderRepo)
    {
        $this->couponMasterOrderRepository = $couponMasterOrderRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/couponMasterOrders",
     *      summary="Get a listing of the Coupon_master_orders.",
     *      tags={"Coupon_master_order"},
     *      description="Get all Coupon_master_orders",
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
     *                  @SWG\Items(ref="#/definitions/Coupon_master_order")
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
        $couponMasterOrders = $this->couponMasterOrderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Coupon_master_orderResource::collection($couponMasterOrders), 'Coupon Master Orders retrieved successfully');
    }

    public function order_coupon(Request $request)
    {
        $today = date('Y-m-d');
        $coupon = Coupon_master_order::where('created_by',$request->business_id)
                                        ->whereDate('start_date','<=', $today)
                                        ->whereDate('end_date','>=', $today)
                                        ->get();


        if($coupon != ''){
            return response(['status'=>'200','Message'=>'coupon retrieved successfully.','coupon' => $coupon]);

        }else{
            return response(['status'=>'401','Message'=>"coupon Not Found"]);

        }
    }

    /**
     * @param CreateCoupon_master_orderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/couponMasterOrders",
     *      summary="Store a newly created Coupon_master_order in storage",
     *      tags={"Coupon_master_order"},
     *      description="Store Coupon_master_order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Coupon_master_order that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Coupon_master_order")
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
     *                  ref="#/definitions/Coupon_master_order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCoupon_master_orderAPIRequest $request)
    {
        $input = $request->all();

        $couponMasterOrder = $this->couponMasterOrderRepository->create($input);

        return $this->sendResponse(new Coupon_master_orderResource($couponMasterOrder), 'Coupon Master Order saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/couponMasterOrders/{id}",
     *      summary="Display the specified Coupon_master_order",
     *      tags={"Coupon_master_order"},
     *      description="Get Coupon_master_order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon_master_order",
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
     *                  ref="#/definitions/Coupon_master_order"
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
        /** @var Coupon_master_order $couponMasterOrder */
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            return $this->sendError('Coupon Master Order not found');
        }

        return $this->sendResponse(new Coupon_master_orderResource($couponMasterOrder), 'Coupon Master Order retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCoupon_master_orderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/couponMasterOrders/{id}",
     *      summary="Update the specified Coupon_master_order in storage",
     *      tags={"Coupon_master_order"},
     *      description="Update Coupon_master_order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon_master_order",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Coupon_master_order that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Coupon_master_order")
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
     *                  ref="#/definitions/Coupon_master_order"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCoupon_master_orderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Coupon_master_order $couponMasterOrder */
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            return $this->sendError('Coupon Master Order not found');
        }

        $couponMasterOrder = $this->couponMasterOrderRepository->update($input, $id);

        return $this->sendResponse(new Coupon_master_orderResource($couponMasterOrder), 'Coupon_master_order updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/couponMasterOrders/{id}",
     *      summary="Remove the specified Coupon_master_order from storage",
     *      tags={"Coupon_master_order"},
     *      description="Delete Coupon_master_order",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon_master_order",
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
        /** @var Coupon_master_order $couponMasterOrder */
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            return $this->sendError('Coupon Master Order not found');
        }

        $couponMasterOrder->delete();

        return $this->sendSuccess('Coupon Master Order deleted successfully');
    }
}
