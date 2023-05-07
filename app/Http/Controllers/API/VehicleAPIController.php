<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVehicleAPIRequest;
use App\Http\Requests\API\UpdateVehicleAPIRequest;
use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\VehicleResource;
use Response;

/**
 * Class VehicleController
 * @package App\Http\Controllers\API
 */

class VehicleAPIController extends AppBaseController
{
    /** @var  VehicleRepository */
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->vehicleRepository = $vehicleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/vehicles",
     *      summary="Get a listing of the Vehicles.",
     *      tags={"Vehicle"},
     *      description="Get all Vehicles",
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
     *                  @SWG\Items(ref="#/definitions/Vehicle")
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
        $vehicles = $this->vehicleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(VehicleResource::collection($vehicles), 'Vehicles retrieved successfully');
    }

    /**
     * @param CreateVehicleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/vehicles",
     *      summary="Store a newly created Vehicle in storage",
     *      tags={"Vehicle"},
     *      description="Store Vehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Vehicle that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Vehicle")
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
     *                  ref="#/definitions/Vehicle"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVehicleAPIRequest $request)
    {
        $input = $request->all();

        $vehicle = $this->vehicleRepository->create($input);

        return $this->sendResponse(new VehicleResource($vehicle), 'Vehicle saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/vehicles/{id}",
     *      summary="Display the specified Vehicle",
     *      tags={"Vehicle"},
     *      description="Get Vehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Vehicle",
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
     *                  ref="#/definitions/Vehicle"
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
        /** @var Vehicle $vehicle */
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            return $this->sendError('Vehicle not found');
        }

        return $this->sendResponse(new VehicleResource($vehicle), 'Vehicle retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVehicleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/vehicles/{id}",
     *      summary="Update the specified Vehicle in storage",
     *      tags={"Vehicle"},
     *      description="Update Vehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Vehicle",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Vehicle that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Vehicle")
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
     *                  ref="#/definitions/Vehicle"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVehicleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Vehicle $vehicle */
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            return $this->sendError('Vehicle not found');
        }

        $vehicle = $this->vehicleRepository->update($input, $id);

        return $this->sendResponse(new VehicleResource($vehicle), 'Vehicle updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/vehicles/{id}",
     *      summary="Remove the specified Vehicle from storage",
     *      tags={"Vehicle"},
     *      description="Delete Vehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Vehicle",
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
        /** @var Vehicle $vehicle */
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            return $this->sendError('Vehicle not found');
        }

        $vehicle->delete();

        return $this->sendSuccess('Vehicle deleted successfully');
    }
}
