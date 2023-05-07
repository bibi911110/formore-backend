<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHoliday_masterAPIRequest;
use App\Http\Requests\API\UpdateHoliday_masterAPIRequest;
use App\Models\Holiday_master;
use App\Repositories\Holiday_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Holiday_masterResource;
use Response;

/**
 * Class Holiday_masterController
 * @package App\Http\Controllers\API
 */

class Holiday_masterAPIController extends AppBaseController
{
    /** @var  Holiday_masterRepository */
    private $holidayMasterRepository;

    public function __construct(Holiday_masterRepository $holidayMasterRepo)
    {
        $this->holidayMasterRepository = $holidayMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/holidayMasters",
     *      summary="Get a listing of the Holiday_masters.",
     *      tags={"Holiday_master"},
     *      description="Get all Holiday_masters",
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
     *                  @SWG\Items(ref="#/definitions/Holiday_master")
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
        $holidayMasters = $this->holidayMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Holiday_masterResource::collection($holidayMasters), 'Holiday Masters retrieved successfully');
    }

    /**
     * @param CreateHoliday_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/holidayMasters",
     *      summary="Store a newly created Holiday_master in storage",
     *      tags={"Holiday_master"},
     *      description="Store Holiday_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Holiday_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Holiday_master")
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
     *                  ref="#/definitions/Holiday_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHoliday_masterAPIRequest $request)
    {
        $input = $request->all();

        $holidayMaster = $this->holidayMasterRepository->create($input);

        return $this->sendResponse(new Holiday_masterResource($holidayMaster), 'Holiday Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/holidayMasters/{id}",
     *      summary="Display the specified Holiday_master",
     *      tags={"Holiday_master"},
     *      description="Get Holiday_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Holiday_master",
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
     *                  ref="#/definitions/Holiday_master"
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
        /** @var Holiday_master $holidayMaster */
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            return $this->sendError('Holiday Master not found');
        }

        return $this->sendResponse(new Holiday_masterResource($holidayMaster), 'Holiday Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateHoliday_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/holidayMasters/{id}",
     *      summary="Update the specified Holiday_master in storage",
     *      tags={"Holiday_master"},
     *      description="Update Holiday_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Holiday_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Holiday_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Holiday_master")
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
     *                  ref="#/definitions/Holiday_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHoliday_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Holiday_master $holidayMaster */
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            return $this->sendError('Holiday Master not found');
        }

        $holidayMaster = $this->holidayMasterRepository->update($input, $id);

        return $this->sendResponse(new Holiday_masterResource($holidayMaster), 'Holiday_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/holidayMasters/{id}",
     *      summary="Remove the specified Holiday_master from storage",
     *      tags={"Holiday_master"},
     *      description="Delete Holiday_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Holiday_master",
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
        /** @var Holiday_master $holidayMaster */
        $holidayMaster = $this->holidayMasterRepository->find($id);

        if (empty($holidayMaster)) {
            return $this->sendError('Holiday Master not found');
        }

        $holidayMaster->delete();

        return $this->sendSuccess('Holiday Master deleted successfully');
    }
}
