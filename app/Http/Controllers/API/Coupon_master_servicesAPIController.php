<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCoupon_master_servicesAPIRequest;
use App\Http\Requests\API\UpdateCoupon_master_servicesAPIRequest;
use App\Models\Coupon_master_services;
use App\Repositories\Coupon_master_servicesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Coupon_master_servicesResource;
use Response;

/**
 * Class Coupon_master_servicesController
 * @package App\Http\Controllers\API
 */

class Coupon_master_servicesAPIController extends AppBaseController
{
    /** @var  Coupon_master_servicesRepository */
    private $couponMasterServicesRepository;

    public function __construct(Coupon_master_servicesRepository $couponMasterServicesRepo)
    {
        $this->couponMasterServicesRepository = $couponMasterServicesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/couponMasterServices",
     *      summary="Get a listing of the Coupon_master_services.",
     *      tags={"Coupon_master_services"},
     *      description="Get all Coupon_master_services",
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
     *                  @SWG\Items(ref="#/definitions/Coupon_master_services")
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
        $couponMasterServices = $this->couponMasterServicesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Coupon_master_servicesResource::collection($couponMasterServices), 'Coupon Master Services retrieved successfully');
    }

 public function booking_coupon(Request $request)
    {
        $today = date('Y-m-d');
        $coupon = Coupon_master_services::where('created_by',$request->business_id)
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
     * @param CreateCoupon_master_servicesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/couponMasterServices",
     *      summary="Store a newly created Coupon_master_services in storage",
     *      tags={"Coupon_master_services"},
     *      description="Store Coupon_master_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Coupon_master_services that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Coupon_master_services")
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
     *                  ref="#/definitions/Coupon_master_services"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCoupon_master_servicesAPIRequest $request)
    {
        $input = $request->all();

        $couponMasterServices = $this->couponMasterServicesRepository->create($input);

        return $this->sendResponse(new Coupon_master_servicesResource($couponMasterServices), 'Coupon Master Services saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/couponMasterServices/{id}",
     *      summary="Display the specified Coupon_master_services",
     *      tags={"Coupon_master_services"},
     *      description="Get Coupon_master_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon_master_services",
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
     *                  ref="#/definitions/Coupon_master_services"
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
        /** @var Coupon_master_services $couponMasterServices */
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            return $this->sendError('Coupon Master Services not found');
        }

        return $this->sendResponse(new Coupon_master_servicesResource($couponMasterServices), 'Coupon Master Services retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCoupon_master_servicesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/couponMasterServices/{id}",
     *      summary="Update the specified Coupon_master_services in storage",
     *      tags={"Coupon_master_services"},
     *      description="Update Coupon_master_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon_master_services",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Coupon_master_services that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Coupon_master_services")
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
     *                  ref="#/definitions/Coupon_master_services"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCoupon_master_servicesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Coupon_master_services $couponMasterServices */
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            return $this->sendError('Coupon Master Services not found');
        }

        $couponMasterServices = $this->couponMasterServicesRepository->update($input, $id);

        return $this->sendResponse(new Coupon_master_servicesResource($couponMasterServices), 'Coupon_master_services updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/couponMasterServices/{id}",
     *      summary="Remove the specified Coupon_master_services from storage",
     *      tags={"Coupon_master_services"},
     *      description="Delete Coupon_master_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Coupon_master_services",
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
        /** @var Coupon_master_services $couponMasterServices */
        $couponMasterServices = $this->couponMasterServicesRepository->find($id);

        if (empty($couponMasterServices)) {
            return $this->sendError('Coupon Master Services not found');
        }

        $couponMasterServices->delete();

        return $this->sendSuccess('Coupon Master Services deleted successfully');
    }
}
