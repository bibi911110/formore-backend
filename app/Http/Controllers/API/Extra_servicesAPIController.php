<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExtra_servicesAPIRequest;
use App\Http\Requests\API\UpdateExtra_servicesAPIRequest;
use App\Models\Extra_services;
use App\Repositories\Extra_servicesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Extra_servicesResource;
use Response;

/**
 * Class Extra_servicesController
 * @package App\Http\Controllers\API
 */

class Extra_servicesAPIController extends AppBaseController
{
    /** @var  Extra_servicesRepository */
    private $extraServicesRepository;

    public function __construct(Extra_servicesRepository $extraServicesRepo)
    {
        $this->extraServicesRepository = $extraServicesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/extraServices",
     *      summary="Get a listing of the Extra_services.",
     *      tags={"Extra_services"},
     *      description="Get all Extra_services",
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
     *                  @SWG\Items(ref="#/definitions/Extra_services")
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
        $extraServices = $this->extraServicesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Extra_servicesResource::collection($extraServices), 'Extra Services retrieved successfully');
    }

    public function booking_extra_product_wise(Request $request)
    {
        $booking_extra_product = Extra_services::where('extra_services.product_id',$request->product_id)
                                            ->leftjoin('services_product','extra_services.product_id','services_product.id')
                                            ->leftjoin('users','services_product.created_by','users.id')
                                            ->leftjoin('brand','users.userDetailsId','brand.id')
                                            ->leftjoin('currency','brand.currency','currency.id')
                                            ->select('extra_services.*','services_product.name as productName','currency.currency_code','currency.currency_name')
                                            ->get();


        if($booking_extra_product != ''){
            return response(['status'=>'200','Message'=>'Booking products retrieved successfully.','booking_extra_product' => $booking_extra_product]);

        }else{
            return response(['status'=>'401','Message'=>"Booking products Not Found"]);

        }
    }

    /**
     * @param CreateExtra_servicesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/extraServices",
     *      summary="Store a newly created Extra_services in storage",
     *      tags={"Extra_services"},
     *      description="Store Extra_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Extra_services that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Extra_services")
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
     *                  ref="#/definitions/Extra_services"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateExtra_servicesAPIRequest $request)
    {
        $input = $request->all();

        $extraServices = $this->extraServicesRepository->create($input);

        return $this->sendResponse(new Extra_servicesResource($extraServices), 'Extra Services saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/extraServices/{id}",
     *      summary="Display the specified Extra_services",
     *      tags={"Extra_services"},
     *      description="Get Extra_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Extra_services",
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
     *                  ref="#/definitions/Extra_services"
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
        /** @var Extra_services $extraServices */
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            return $this->sendError('Extra Services not found');
        }

        return $this->sendResponse(new Extra_servicesResource($extraServices), 'Extra Services retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateExtra_servicesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/extraServices/{id}",
     *      summary="Update the specified Extra_services in storage",
     *      tags={"Extra_services"},
     *      description="Update Extra_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Extra_services",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Extra_services that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Extra_services")
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
     *                  ref="#/definitions/Extra_services"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateExtra_servicesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Extra_services $extraServices */
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            return $this->sendError('Extra Services not found');
        }

        $extraServices = $this->extraServicesRepository->update($input, $id);

        return $this->sendResponse(new Extra_servicesResource($extraServices), 'Extra_services updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/extraServices/{id}",
     *      summary="Remove the specified Extra_services from storage",
     *      tags={"Extra_services"},
     *      description="Delete Extra_services",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Extra_services",
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
        /** @var Extra_services $extraServices */
        $extraServices = $this->extraServicesRepository->find($id);

        if (empty($extraServices)) {
            return $this->sendError('Extra Services not found');
        }

        $extraServices->delete();

        return $this->sendSuccess('Extra Services deleted successfully');
    }
}
