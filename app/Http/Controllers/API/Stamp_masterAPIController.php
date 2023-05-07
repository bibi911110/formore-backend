<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStamp_masterAPIRequest;
use App\Http\Requests\API\UpdateStamp_masterAPIRequest;
use App\Models\Stamp_master;
use App\Repositories\Stamp_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Stamp_masterResource;
use Response;

/**
 * Class Stamp_masterController
 * @package App\Http\Controllers\API
 */

class Stamp_masterAPIController extends AppBaseController
{
    /** @var  Stamp_masterRepository */
    private $stampMasterRepository;

    public function __construct(Stamp_masterRepository $stampMasterRepo)
    {
        $this->stampMasterRepository = $stampMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stampMasters",
     *      summary="Get a listing of the Stamp_masters.",
     *      tags={"Stamp_master"},
     *      description="Get all Stamp_masters",
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
     *                  @SWG\Items(ref="#/definitions/Stamp_master")
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
        $stampMasters = $this->stampMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Stamp_masterResource::collection($stampMasters), 'Stamp Masters retrieved successfully');
    }

    /**
     * @param CreateStamp_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stampMasters",
     *      summary="Store a newly created Stamp_master in storage",
     *      tags={"Stamp_master"},
     *      description="Store Stamp_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Stamp_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Stamp_master")
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
     *                  ref="#/definitions/Stamp_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStamp_masterAPIRequest $request)
    {
        $input = $request->all();

        $stampMaster = $this->stampMasterRepository->create($input);

        return $this->sendResponse(new Stamp_masterResource($stampMaster), 'Stamp Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stampMasters/{id}",
     *      summary="Display the specified Stamp_master",
     *      tags={"Stamp_master"},
     *      description="Get Stamp_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Stamp_master",
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
     *                  ref="#/definitions/Stamp_master"
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
        /** @var Stamp_master $stampMaster */
        $stampMaster = $this->stampMasterRepository->find($id);

        if (empty($stampMaster)) {
            return $this->sendError('Stamp Master not found');
        }

        return $this->sendResponse(new Stamp_masterResource($stampMaster), 'Stamp Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStamp_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stampMasters/{id}",
     *      summary="Update the specified Stamp_master in storage",
     *      tags={"Stamp_master"},
     *      description="Update Stamp_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Stamp_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Stamp_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Stamp_master")
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
     *                  ref="#/definitions/Stamp_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStamp_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Stamp_master $stampMaster */
        $stampMaster = $this->stampMasterRepository->find($id);

        if (empty($stampMaster)) {
            return $this->sendError('Stamp Master not found');
        }

        $stampMaster = $this->stampMasterRepository->update($input, $id);

        return $this->sendResponse(new Stamp_masterResource($stampMaster), 'Stamp_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stampMasters/{id}",
     *      summary="Remove the specified Stamp_master from storage",
     *      tags={"Stamp_master"},
     *      description="Delete Stamp_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Stamp_master",
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
        /** @var Stamp_master $stampMaster */
        $stampMaster = $this->stampMasterRepository->find($id);

        if (empty($stampMaster)) {
            return $this->sendError('Stamp Master not found');
        }

        $stampMaster->delete();

        return $this->sendSuccess('Stamp Master deleted successfully');
    }
}
