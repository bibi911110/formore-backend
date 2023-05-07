<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePromotional_image_masterAPIRequest;
use App\Http\Requests\API\UpdatePromotional_image_masterAPIRequest;
use App\Models\Promotional_image_master;
use App\Repositories\Promotional_image_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Promotional_image_masterResource;
use Response;

/**
 * Class Promotional_image_masterController
 * @package App\Http\Controllers\API
 */

class Promotional_image_masterAPIController extends AppBaseController
{
    /** @var  Promotional_image_masterRepository */
    private $promotionalImageMasterRepository;

    public function __construct(Promotional_image_masterRepository $promotionalImageMasterRepo)
    {
        $this->promotionalImageMasterRepository = $promotionalImageMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/promotionalImageMasters",
     *      summary="Get a listing of the Promotional_image_masters.",
     *      tags={"Promotional_image_master"},
     *      description="Get all Promotional_image_masters",
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
     *                  @SWG\Items(ref="#/definitions/Promotional_image_master")
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
        /*$promotionalImageMasters = $this->promotionalImageMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Promotional_image_masterResource::collection($promotionalImageMasters), 'Promotional Image Masters retrieved successfully');*/
        $today = date('Y-m-d');
        $promotionalImageMasters = Promotional_image_master::whereDate('from_date','<=', $today)
            ->whereDate('to_date','>=', $today)->get();
        if($promotionalImageMasters != ''){
            return response(['status'=>'200','Message'=>'Promotional Image Masters retrieved successfully.','promotionalImageMasters' => $promotionalImageMasters]);
        }else{
            return response(['status'=>'401','Message'=>"Promotional Image Masters Not Found"]);
        }
    }

    /**
     * @param CreatePromotional_image_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/promotionalImageMasters",
     *      summary="Store a newly created Promotional_image_master in storage",
     *      tags={"Promotional_image_master"},
     *      description="Store Promotional_image_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Promotional_image_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Promotional_image_master")
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
     *                  ref="#/definitions/Promotional_image_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePromotional_image_masterAPIRequest $request)
    {
        $input = $request->all();

        $promotionalImageMaster = $this->promotionalImageMasterRepository->create($input);

        return $this->sendResponse(new Promotional_image_masterResource($promotionalImageMaster), 'Promotional Image Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/promotionalImageMasters/{id}",
     *      summary="Display the specified Promotional_image_master",
     *      tags={"Promotional_image_master"},
     *      description="Get Promotional_image_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Promotional_image_master",
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
     *                  ref="#/definitions/Promotional_image_master"
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
        /** @var Promotional_image_master $promotionalImageMaster */
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            return $this->sendError('Promotional Image Master not found');
        }

        return $this->sendResponse(new Promotional_image_masterResource($promotionalImageMaster), 'Promotional Image Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePromotional_image_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/promotionalImageMasters/{id}",
     *      summary="Update the specified Promotional_image_master in storage",
     *      tags={"Promotional_image_master"},
     *      description="Update Promotional_image_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Promotional_image_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Promotional_image_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Promotional_image_master")
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
     *                  ref="#/definitions/Promotional_image_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePromotional_image_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Promotional_image_master $promotionalImageMaster */
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            return $this->sendError('Promotional Image Master not found');
        }

        $promotionalImageMaster = $this->promotionalImageMasterRepository->update($input, $id);

        return $this->sendResponse(new Promotional_image_masterResource($promotionalImageMaster), 'Promotional_image_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/promotionalImageMasters/{id}",
     *      summary="Remove the specified Promotional_image_master from storage",
     *      tags={"Promotional_image_master"},
     *      description="Delete Promotional_image_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Promotional_image_master",
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
        /** @var Promotional_image_master $promotionalImageMaster */
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            return $this->sendError('Promotional Image Master not found');
        }

        $promotionalImageMaster->delete();

        return $this->sendSuccess('Promotional Image Master deleted successfully');
    }
}
