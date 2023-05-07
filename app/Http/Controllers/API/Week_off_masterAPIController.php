<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWeek_off_masterAPIRequest;
use App\Http\Requests\API\UpdateWeek_off_masterAPIRequest;
use App\Models\Week_off_master;
use App\Repositories\Week_off_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Week_off_masterResource;
use Response;

/**
 * Class Week_off_masterController
 * @package App\Http\Controllers\API
 */

class Week_off_masterAPIController extends AppBaseController
{
    /** @var  Week_off_masterRepository */
    private $weekOffMasterRepository;

    public function __construct(Week_off_masterRepository $weekOffMasterRepo)
    {
        $this->weekOffMasterRepository = $weekOffMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/weekOffMasters",
     *      summary="Get a listing of the Week_off_masters.",
     *      tags={"Week_off_master"},
     *      description="Get all Week_off_masters",
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
     *                  @SWG\Items(ref="#/definitions/Week_off_master")
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
        $weekOffMasters = $this->weekOffMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Week_off_masterResource::collection($weekOffMasters), 'Week Off Masters retrieved successfully');
    }

    /**
     * @param CreateWeek_off_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/weekOffMasters",
     *      summary="Store a newly created Week_off_master in storage",
     *      tags={"Week_off_master"},
     *      description="Store Week_off_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Week_off_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Week_off_master")
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
     *                  ref="#/definitions/Week_off_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWeek_off_masterAPIRequest $request)
    {
        $input = $request->all();

        $weekOffMaster = $this->weekOffMasterRepository->create($input);

        return $this->sendResponse(new Week_off_masterResource($weekOffMaster), 'Week Off Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/weekOffMasters/{id}",
     *      summary="Display the specified Week_off_master",
     *      tags={"Week_off_master"},
     *      description="Get Week_off_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Week_off_master",
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
     *                  ref="#/definitions/Week_off_master"
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
        /** @var Week_off_master $weekOffMaster */
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            return $this->sendError('Week Off Master not found');
        }

        return $this->sendResponse(new Week_off_masterResource($weekOffMaster), 'Week Off Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateWeek_off_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/weekOffMasters/{id}",
     *      summary="Update the specified Week_off_master in storage",
     *      tags={"Week_off_master"},
     *      description="Update Week_off_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Week_off_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Week_off_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Week_off_master")
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
     *                  ref="#/definitions/Week_off_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWeek_off_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Week_off_master $weekOffMaster */
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            return $this->sendError('Week Off Master not found');
        }

        $weekOffMaster = $this->weekOffMasterRepository->update($input, $id);

        return $this->sendResponse(new Week_off_masterResource($weekOffMaster), 'Week_off_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/weekOffMasters/{id}",
     *      summary="Remove the specified Week_off_master from storage",
     *      tags={"Week_off_master"},
     *      description="Delete Week_off_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Week_off_master",
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
        /** @var Week_off_master $weekOffMaster */
        $weekOffMaster = $this->weekOffMasterRepository->find($id);

        if (empty($weekOffMaster)) {
            return $this->sendError('Week Off Master not found');
        }

        $weekOffMaster->delete();

        return $this->sendSuccess('Week Off Master deleted successfully');
    }
}
