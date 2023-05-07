<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSlot_masterAPIRequest;
use App\Http\Requests\API\UpdateSlot_masterAPIRequest;
use App\Models\Slot_master;
use App\Repositories\Slot_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Slot_masterResource;
use Response;

/**
 * Class Slot_masterController
 * @package App\Http\Controllers\API
 */

class Slot_masterAPIController extends AppBaseController
{
    /** @var  Slot_masterRepository */
    private $slotMasterRepository;

    public function __construct(Slot_masterRepository $slotMasterRepo)
    {
        $this->slotMasterRepository = $slotMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/slotMasters",
     *      summary="Get a listing of the Slot_masters.",
     *      tags={"Slot_master"},
     *      description="Get all Slot_masters",
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
     *                  @SWG\Items(ref="#/definitions/Slot_master")
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
        $slotMasters = $this->slotMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Slot_masterResource::collection($slotMasters), 'Slot Masters retrieved successfully');
    }

    public function get_slot(Request $request)
    {
        //$slot_master = Slot_master::where('created_by',$request->business_id)->get();

        $slot_master = \App\Models\Slot_timing::where('business_id',$request->business_id)->get();
        foreach ($slot_master as $value) {
            $booked = \App\Models\Booking_add_cart_time_order::where('slot_id',$value['id'])->count();
            if($value['limit_per_slot'] > $booked)
            {
                $available_slot[] = $value;
            }

        }

        $week_off = \App\Models\Week_off_master::where('created_by',$request->business_id)->get();

        $holiday1 = \App\Models\Holiday_master::where('created_by',$request->business_id)->get();
        $holiday = [];
        foreach ($holiday1 as  $value) {
           $holiday[] = array('id' => $value->id,'created_by' => $value->created_by,'holiday_date' => date('Y-m-d',strtotime($value->holiday_date)));
        }



        if($available_slot != '' || $week_off = '' || $holiday = ''){
            return response(['status'=>'200','Message'=>' Slot retrieved successfully.','slot_master' => $available_slot,'week_off' => $week_off,'holiday' => $holiday]);

        }else{
            return response(['status'=>'401','Message'=>" Slot Not Found"]);

        }
    }

    public function get_slot_list(Request $request)
    {
        //$buss_id = \App\User::where('id',$request->user_id)->first();
        
        //$business_id  = \App\User::where('id',$request->user_id)->where('role_id','3')->where('user_type','3')->first(); 
        
        $slot_timing = \App\Models\Slot_timing::where('business_id',$request->user_id)->get();
       if($slot_timing != '' ){
            return response(['status'=>'200','Message'=>' Slot retrieved successfully.','slot_timing' => $slot_timing]);

        }else{
            return response(['status'=>'401','Message'=>" Slot Not Found"]);

        } 
    }

    /**
     * @param CreateSlot_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/slotMasters",
     *      summary="Store a newly created Slot_master in storage",
     *      tags={"Slot_master"},
     *      description="Store Slot_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Slot_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Slot_master")
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
     *                  ref="#/definitions/Slot_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSlot_masterAPIRequest $request)
    {
        $input = $request->all();

        $slotMaster = $this->slotMasterRepository->create($input);

        return $this->sendResponse(new Slot_masterResource($slotMaster), 'Slot Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/slotMasters/{id}",
     *      summary="Display the specified Slot_master",
     *      tags={"Slot_master"},
     *      description="Get Slot_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Slot_master",
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
     *                  ref="#/definitions/Slot_master"
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
        /** @var Slot_master $slotMaster */
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            return $this->sendError('Slot Master not found');
        }

        return $this->sendResponse(new Slot_masterResource($slotMaster), 'Slot Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSlot_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/slotMasters/{id}",
     *      summary="Update the specified Slot_master in storage",
     *      tags={"Slot_master"},
     *      description="Update Slot_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Slot_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Slot_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Slot_master")
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
     *                  ref="#/definitions/Slot_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSlot_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Slot_master $slotMaster */
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            return $this->sendError('Slot Master not found');
        }

        $slotMaster = $this->slotMasterRepository->update($input, $id);

        return $this->sendResponse(new Slot_masterResource($slotMaster), 'Slot_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/slotMasters/{id}",
     *      summary="Remove the specified Slot_master from storage",
     *      tags={"Slot_master"},
     *      description="Delete Slot_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Slot_master",
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
        /** @var Slot_master $slotMaster */
        $slotMaster = $this->slotMasterRepository->find($id);

        if (empty($slotMaster)) {
            return $this->sendError('Slot Master not found');
        }

        $slotMaster->delete();

        return $this->sendSuccess('Slot Master deleted successfully');
    }
}
