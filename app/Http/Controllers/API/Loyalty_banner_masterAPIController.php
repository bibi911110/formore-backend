<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLoyalty_banner_masterAPIRequest;
use App\Http\Requests\API\UpdateLoyalty_banner_masterAPIRequest;
use App\Models\Loyalty_banner_master;
use App\Repositories\Loyalty_banner_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Loyalty_banner_masterResource;
use Response;

/**
 * Class Loyalty_banner_masterController
 * @package App\Http\Controllers\API
 */

class Loyalty_banner_masterAPIController extends AppBaseController
{
    /** @var  Loyalty_banner_masterRepository */
    private $loyaltyBannerMasterRepository;

    public function __construct(Loyalty_banner_masterRepository $loyaltyBannerMasterRepo)
    {
        $this->loyaltyBannerMasterRepository = $loyaltyBannerMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/loyaltyBannerMasters",
     *      summary="Get a listing of the Loyalty_banner_masters.",
     *      tags={"Loyalty_banner_master"},
     *      description="Get all Loyalty_banner_masters",
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
     *                  @SWG\Items(ref="#/definitions/Loyalty_banner_master")
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
       /* $loyaltyBannerMasters = $this->loyaltyBannerMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Loyalty_banner_masterResource::collection($loyaltyBannerMasters), 'Loyalty Banner Masters retrieved successfully');*/

        $loyaltyBannerMasters = Loyalty_banner_master::get();
        if($loyaltyBannerMasters != ''){
            return response(['status'=>'200','Message'=>'Loyalty Banner Masters retrieved successfully.','loyaltyBannerMasters' => $loyaltyBannerMasters]);
        }else{
            return response(['status'=>'401','Message'=>"Loyalty Banner Masters Not Found"]);
        }
    }

    /**
     * @param CreateLoyalty_banner_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/loyaltyBannerMasters",
     *      summary="Store a newly created Loyalty_banner_master in storage",
     *      tags={"Loyalty_banner_master"},
     *      description="Store Loyalty_banner_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Loyalty_banner_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Loyalty_banner_master")
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
     *                  ref="#/definitions/Loyalty_banner_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLoyalty_banner_masterAPIRequest $request)
    {
        $input = $request->all();

        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->create($input);

        return $this->sendResponse(new Loyalty_banner_masterResource($loyaltyBannerMaster), 'Loyalty Banner Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/loyaltyBannerMasters/{id}",
     *      summary="Display the specified Loyalty_banner_master",
     *      tags={"Loyalty_banner_master"},
     *      description="Get Loyalty_banner_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Loyalty_banner_master",
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
     *                  ref="#/definitions/Loyalty_banner_master"
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
        /** @var Loyalty_banner_master $loyaltyBannerMaster */
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            return $this->sendError('Loyalty Banner Master not found');
        }

        return $this->sendResponse(new Loyalty_banner_masterResource($loyaltyBannerMaster), 'Loyalty Banner Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLoyalty_banner_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/loyaltyBannerMasters/{id}",
     *      summary="Update the specified Loyalty_banner_master in storage",
     *      tags={"Loyalty_banner_master"},
     *      description="Update Loyalty_banner_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Loyalty_banner_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Loyalty_banner_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Loyalty_banner_master")
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
     *                  ref="#/definitions/Loyalty_banner_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLoyalty_banner_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Loyalty_banner_master $loyaltyBannerMaster */
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            return $this->sendError('Loyalty Banner Master not found');
        }

        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->update($input, $id);

        return $this->sendResponse(new Loyalty_banner_masterResource($loyaltyBannerMaster), 'Loyalty_banner_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/loyaltyBannerMasters/{id}",
     *      summary="Remove the specified Loyalty_banner_master from storage",
     *      tags={"Loyalty_banner_master"},
     *      description="Delete Loyalty_banner_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Loyalty_banner_master",
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
        /** @var Loyalty_banner_master $loyaltyBannerMaster */
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            return $this->sendError('Loyalty Banner Master not found');
        }

        $loyaltyBannerMaster->delete();

        return $this->sendSuccess('Loyalty Banner Master deleted successfully');
    }
}
