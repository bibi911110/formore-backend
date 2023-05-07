<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNotification_masterAPIRequest;
use App\Http\Requests\API\UpdateNotification_masterAPIRequest;
use App\Models\Notification_master;
use App\Repositories\Notification_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Notification_masterResource;
use Response;

/**
 * Class Notification_masterController
 * @package App\Http\Controllers\API
 */

class Notification_masterAPIController extends AppBaseController
{
    /** @var  Notification_masterRepository */
    private $notificationMasterRepository;

    public function __construct(Notification_masterRepository $notificationMasterRepo)
    {
        $this->notificationMasterRepository = $notificationMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/notificationMasters",
     *      summary="Get a listing of the Notification_masters.",
     *      tags={"Notification_master"},
     *      description="Get all Notification_masters",
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
     *                  @SWG\Items(ref="#/definitions/Notification_master")
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
        $notificationMasters = $this->notificationMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Notification_masterResource::collection($notificationMasters), 'Notification Masters retrieved successfully');
    }

    /**
     * @param CreateNotification_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/notificationMasters",
     *      summary="Store a newly created Notification_master in storage",
     *      tags={"Notification_master"},
     *      description="Store Notification_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Notification_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Notification_master")
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
     *                  ref="#/definitions/Notification_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNotification_masterAPIRequest $request)
    {
        $input = $request->all();

        $notificationMaster = $this->notificationMasterRepository->create($input);

        return $this->sendResponse(new Notification_masterResource($notificationMaster), 'Notification Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/notificationMasters/{id}",
     *      summary="Display the specified Notification_master",
     *      tags={"Notification_master"},
     *      description="Get Notification_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Notification_master",
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
     *                  ref="#/definitions/Notification_master"
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
        /** @var Notification_master $notificationMaster */
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            return $this->sendError('Notification Master not found');
        }

        return $this->sendResponse(new Notification_masterResource($notificationMaster), 'Notification Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNotification_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/notificationMasters/{id}",
     *      summary="Update the specified Notification_master in storage",
     *      tags={"Notification_master"},
     *      description="Update Notification_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Notification_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Notification_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Notification_master")
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
     *                  ref="#/definitions/Notification_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNotification_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Notification_master $notificationMaster */
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            return $this->sendError('Notification Master not found');
        }

        $notificationMaster = $this->notificationMasterRepository->update($input, $id);

        return $this->sendResponse(new Notification_masterResource($notificationMaster), 'Notification_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/notificationMasters/{id}",
     *      summary="Remove the specified Notification_master from storage",
     *      tags={"Notification_master"},
     *      description="Delete Notification_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Notification_master",
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
        /** @var Notification_master $notificationMaster */
        $notificationMaster = $this->notificationMasterRepository->find($id);

        if (empty($notificationMaster)) {
            return $this->sendError('Notification Master not found');
        }

        $notificationMaster->delete();

        return $this->sendSuccess('Notification Master deleted successfully');
    }
}
