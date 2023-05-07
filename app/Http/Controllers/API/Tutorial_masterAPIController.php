<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTutorial_masterAPIRequest;
use App\Http\Requests\API\UpdateTutorial_masterAPIRequest;
use App\Models\Tutorial_master;
use App\Repositories\Tutorial_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Tutorial_masterResource;
use Response;

/**
 * Class Tutorial_masterController
 * @package App\Http\Controllers\API
 */

class Tutorial_masterAPIController extends AppBaseController
{
    /** @var  Tutorial_masterRepository */
    private $tutorialMasterRepository;

    public function __construct(Tutorial_masterRepository $tutorialMasterRepo)
    {
        $this->tutorialMasterRepository = $tutorialMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tutorialMasters",
     *      summary="Get a listing of the Tutorial_masters.",
     *      tags={"Tutorial_master"},
     *      description="Get all Tutorial_masters",
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
     *                  @SWG\Items(ref="#/definitions/Tutorial_master")
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
       /* $tutorialMasters = $this->tutorialMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Tutorial_masterResource::collection($tutorialMasters), 'Tutorial Masters retrieved successfully');*/

        $tutorialMasters = Tutorial_master::where('status',1)->get();
        if($tutorialMasters != ''){
            return response(['success'=>'true','Message'=>'Tutorial Masters retrieved successfully.','tutorialMasters' => $tutorialMasters]);
        }else{
            return response(['success'=>'false','Message'=>"Tutorial Masters Not Found"]);
        }
    }

     public function tutorial_master_language_wise(Request $request)
    {
       /* $tutorialMasters = $this->tutorialMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Tutorial_masterResource::collection($tutorialMasters), 'Tutorial Masters retrieved successfully');*/

        $tutorialMasters = Tutorial_master::where('status',1)->where('language_id',$request->language_id)->get();
        if($tutorialMasters != ''){
            return response(['success'=>'true','Message'=>'Tutorial Masters retrieved successfully.','tutorialMasters' => $tutorialMasters]);
        }else{
            return response(['success'=>'false','Message'=>"Tutorial Masters Not Found"]);
        }
    }



    /**
     * @param CreateTutorial_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tutorialMasters",
     *      summary="Store a newly created Tutorial_master in storage",
     *      tags={"Tutorial_master"},
     *      description="Store Tutorial_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tutorial_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tutorial_master")
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
     *                  ref="#/definitions/Tutorial_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTutorial_masterAPIRequest $request)
    {
        $input = $request->all();

        $tutorialMaster = $this->tutorialMasterRepository->create($input);

        return $this->sendResponse(new Tutorial_masterResource($tutorialMaster), 'Tutorial Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tutorialMasters/{id}",
     *      summary="Display the specified Tutorial_master",
     *      tags={"Tutorial_master"},
     *      description="Get Tutorial_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tutorial_master",
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
     *                  ref="#/definitions/Tutorial_master"
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
        /** @var Tutorial_master $tutorialMaster */
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            return $this->sendError('Tutorial Master not found');
        }

        return $this->sendResponse(new Tutorial_masterResource($tutorialMaster), 'Tutorial Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTutorial_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tutorialMasters/{id}",
     *      summary="Update the specified Tutorial_master in storage",
     *      tags={"Tutorial_master"},
     *      description="Update Tutorial_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tutorial_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tutorial_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tutorial_master")
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
     *                  ref="#/definitions/Tutorial_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTutorial_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tutorial_master $tutorialMaster */
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            return $this->sendError('Tutorial Master not found');
        }

        $tutorialMaster = $this->tutorialMasterRepository->update($input, $id);

        return $this->sendResponse(new Tutorial_masterResource($tutorialMaster), 'Tutorial_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tutorialMasters/{id}",
     *      summary="Remove the specified Tutorial_master from storage",
     *      tags={"Tutorial_master"},
     *      description="Delete Tutorial_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tutorial_master",
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
        /** @var Tutorial_master $tutorialMaster */
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            return $this->sendError('Tutorial Master not found');
        }

        $tutorialMaster->delete();

        return $this->sendSuccess('Tutorial Master deleted successfully');
    }
}
