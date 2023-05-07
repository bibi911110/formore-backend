<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNfc_masterAPIRequest;
use App\Http\Requests\API\UpdateNfc_masterAPIRequest;
use App\Models\Nfc_master;
use App\Repositories\Nfc_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Nfc_masterResource;
use Response;

/**
 * Class Nfc_masterController
 * @package App\Http\Controllers\API
 */

class Nfc_masterAPIController extends AppBaseController
{
    /** @var  Nfc_masterRepository */
    private $nfcMasterRepository;

    public function __construct(Nfc_masterRepository $nfcMasterRepo)
    {
        $this->nfcMasterRepository = $nfcMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/nfcMasters",
     *      summary="Get a listing of the Nfc_masters.",
     *      tags={"Nfc_master"},
     *      description="Get all Nfc_masters",
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
     *                  @SWG\Items(ref="#/definitions/Nfc_master")
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
        $nfcMasters = $this->nfcMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Nfc_masterResource::collection($nfcMasters), 'Nfc Masters retrieved successfully');
    }

    /**
     * @param CreateNfc_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/nfcMasters",
     *      summary="Store a newly created Nfc_master in storage",
     *      tags={"Nfc_master"},
     *      description="Store Nfc_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Nfc_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nfc_master")
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
     *                  ref="#/definitions/Nfc_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNfc_masterAPIRequest $request)
    {
        $input = $request->all();

        $nfcMaster = $this->nfcMasterRepository->create($input);

        return $this->sendResponse(new Nfc_masterResource($nfcMaster), 'Nfc Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/nfcMasters/{id}",
     *      summary="Display the specified Nfc_master",
     *      tags={"Nfc_master"},
     *      description="Get Nfc_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nfc_master",
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
     *                  ref="#/definitions/Nfc_master"
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
        /** @var Nfc_master $nfcMaster */
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            return $this->sendError('Nfc Master not found');
        }

        return $this->sendResponse(new Nfc_masterResource($nfcMaster), 'Nfc Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNfc_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/nfcMasters/{id}",
     *      summary="Update the specified Nfc_master in storage",
     *      tags={"Nfc_master"},
     *      description="Update Nfc_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nfc_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Nfc_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nfc_master")
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
     *                  ref="#/definitions/Nfc_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNfc_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Nfc_master $nfcMaster */
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            return $this->sendError('Nfc Master not found');
        }

        $nfcMaster = $this->nfcMasterRepository->update($input, $id);

        return $this->sendResponse(new Nfc_masterResource($nfcMaster), 'Nfc_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/nfcMasters/{id}",
     *      summary="Remove the specified Nfc_master from storage",
     *      tags={"Nfc_master"},
     *      description="Delete Nfc_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nfc_master",
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
        /** @var Nfc_master $nfcMaster */
        $nfcMaster = $this->nfcMasterRepository->find($id);

        if (empty($nfcMaster)) {
            return $this->sendError('Nfc Master not found');
        }

        $nfcMaster->delete();

        return $this->sendSuccess('Nfc Master deleted successfully');
    }
}
