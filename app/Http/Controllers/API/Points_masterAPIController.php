<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePoints_masterAPIRequest;
use App\Http\Requests\API\UpdatePoints_masterAPIRequest;
use App\Models\Points_master;
use App\Repositories\Points_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Points_masterResource;
use Response;

/**
 * Class Points_masterController
 * @package App\Http\Controllers\API
 */

class Points_masterAPIController extends AppBaseController
{
    /** @var  Points_masterRepository */
    private $pointsMasterRepository;

    public function __construct(Points_masterRepository $pointsMasterRepo)
    {
        $this->pointsMasterRepository = $pointsMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pointsMasters",
     *      summary="Get a listing of the Points_masters.",
     *      tags={"Points_master"},
     *      description="Get all Points_masters",
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
     *                  @SWG\Items(ref="#/definitions/Points_master")
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
        $pointsMasters = $this->pointsMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Points_masterResource::collection($pointsMasters), 'Points Masters retrieved successfully');
    }

    /**
     * @param CreatePoints_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pointsMasters",
     *      summary="Store a newly created Points_master in storage",
     *      tags={"Points_master"},
     *      description="Store Points_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Points_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Points_master")
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
     *                  ref="#/definitions/Points_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePoints_masterAPIRequest $request)
    {
        $input = $request->all();

        $pointsMaster = $this->pointsMasterRepository->create($input);

        return $this->sendResponse(new Points_masterResource($pointsMaster), 'Points Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pointsMasters/{id}",
     *      summary="Display the specified Points_master",
     *      tags={"Points_master"},
     *      description="Get Points_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Points_master",
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
     *                  ref="#/definitions/Points_master"
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
        /** @var Points_master $pointsMaster */
        $pointsMaster = $this->pointsMasterRepository->find($id);

        if (empty($pointsMaster)) {
            return $this->sendError('Points Master not found');
        }

        return $this->sendResponse(new Points_masterResource($pointsMaster), 'Points Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePoints_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pointsMasters/{id}",
     *      summary="Update the specified Points_master in storage",
     *      tags={"Points_master"},
     *      description="Update Points_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Points_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Points_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Points_master")
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
     *                  ref="#/definitions/Points_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePoints_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Points_master $pointsMaster */
        $pointsMaster = $this->pointsMasterRepository->find($id);

        if (empty($pointsMaster)) {
            return $this->sendError('Points Master not found');
        }

        $pointsMaster = $this->pointsMasterRepository->update($input, $id);

        return $this->sendResponse(new Points_masterResource($pointsMaster), 'Points_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pointsMasters/{id}",
     *      summary="Remove the specified Points_master from storage",
     *      tags={"Points_master"},
     *      description="Delete Points_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Points_master",
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
        /** @var Points_master $pointsMaster */
        $pointsMaster = $this->pointsMasterRepository->find($id);

        if (empty($pointsMaster)) {
            return $this->sendError('Points Master not found');
        }

        $pointsMaster->delete();

        return $this->sendSuccess('Points Master deleted successfully');
    }
}
