<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNotification_detailsAPIRequest;
use App\Http\Requests\API\UpdateNotification_detailsAPIRequest;
use App\Models\Notification_details;
use App\Repositories\Notification_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Notification_detailsResource;
use Response;
use Auth;
/**
 * Class Notification_detailsController
 * @package App\Http\Controllers\API
 */

class Notification_detailsAPIController extends AppBaseController
{
    /** @var  Notification_detailsRepository */
    private $notificationDetailsRepository;

    public function __construct(Notification_detailsRepository $notificationDetailsRepo)
    {
        $this->notificationDetailsRepository = $notificationDetailsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/notificationDetails",
     *      summary="Get a listing of the Notification_details.",
     *      tags={"Notification_details"},
     *      description="Get all Notification_details",
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
     *                  @SWG\Items(ref="#/definitions/Notification_details")
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
       /* $notificationDetails = $this->notificationDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Notification_detailsResource::collection($notificationDetails), 'Notification Details retrieved successfully');*/
        $notificationDetails = Notification_details::leftjoin('notification_master','notification_details.notification_id','notification_master.id')
                                        ->where('notification_master.status',1)
                                        ->select('notification_details.*','notification_master.title','notification_master.details','notification_master.notification_image','notification_master.status')
                                        ->get();
        if($notificationDetails != ''){
            return response(['status'=>'200','Message'=>'Notification Details retrieved successfully.','notificationDetails' => $notificationDetails]);
        }else{
            return response(['status'=>'401','Message'=>"Notification Details Not Found"]);
        }
    }

    public function notification_details_view(Request $request)
    {
        $notificationDetails = Notification_details::leftjoin('notification_master','notification_details.notification_id','notification_master.id')
                                        ->where('notification_master.status',1)
                                        ->where('notification_details.user_id',$request->user_id)
                                        ->orderBy('notification_details.id','DESC')
                                        ->select('notification_details.*','notification_master.title','notification_master.details','notification_master.notification_image','notification_master.status')
                                        ->get();
        if($notificationDetails != ''){
            return response(['status'=>'200','Message'=>'Notification Details retrieved successfully.','notificationDetails' => $notificationDetails]);
        }else{
            return response(['status'=>'401','Message'=>"Notification Details Not Found"]);
        }
    }

    /**
     * @param CreateNotification_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/notificationDetails",
     *      summary="Store a newly created Notification_details in storage",
     *      tags={"Notification_details"},
     *      description="Store Notification_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Notification_details that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Notification_details")
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
     *                  ref="#/definitions/Notification_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNotification_detailsAPIRequest $request)
    {
        $input = $request->all();

        $notificationDetails = $this->notificationDetailsRepository->create($input);

        return $this->sendResponse(new Notification_detailsResource($notificationDetails), 'Notification Details saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/notificationDetails/{id}",
     *      summary="Display the specified Notification_details",
     *      tags={"Notification_details"},
     *      description="Get Notification_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Notification_details",
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
     *                  ref="#/definitions/Notification_details"
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
        /** @var Notification_details $notificationDetails */
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            return $this->sendError('Notification Details not found');
        }

        return $this->sendResponse(new Notification_detailsResource($notificationDetails), 'Notification Details retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNotification_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/notificationDetails/{id}",
     *      summary="Update the specified Notification_details in storage",
     *      tags={"Notification_details"},
     *      description="Update Notification_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Notification_details",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Notification_details that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Notification_details")
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
     *                  ref="#/definitions/Notification_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNotification_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Notification_details $notificationDetails */
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            return $this->sendError('Notification Details not found');
        }

        $notificationDetails = $this->notificationDetailsRepository->update($input, $id);

        return $this->sendResponse(new Notification_detailsResource($notificationDetails), 'Notification_details updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/notificationDetails/{id}",
     *      summary="Remove the specified Notification_details from storage",
     *      tags={"Notification_details"},
     *      description="Delete Notification_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Notification_details",
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
        /** @var Notification_details $notificationDetails */
        $notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            return $this->sendError('Notification Details not found');
        }

        $notificationDetails->delete();

        return $this->sendSuccess('Notification Details deleted successfully');
    }
    public function delete_notification(Request $request)
    {
        $data = Date('Y-m-d : h:s:i');
        $notificationDetails = \App\Models\Notification_details::where('notification_id', $request->notification_id)->where('user_id', $request->user_id)->update(['deleted_at' => $data]);

        /** @var Notification_details $notificationDetails */
        //$notificationDetails = $this->notificationDetailsRepository->find($id);

        if (empty($notificationDetails)) {
            return $this->sendError('Notification Details not found');
        }

        //$notificationDetails->delete();

        return $this->sendSuccess('Notification Details deleted successfully');
    }
}
