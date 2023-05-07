<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLink_masterAPIRequest;
use App\Http\Requests\API\UpdateLink_masterAPIRequest;
use App\Models\Link_master;
use App\Repositories\Link_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Link_masterResource;
use Response;

/**
 * Class Link_masterController
 * @package App\Http\Controllers\API
 */

class Link_masterAPIController extends AppBaseController
{
    /** @var  Link_masterRepository */
    private $linkMasterRepository;

    public function __construct(Link_masterRepository $linkMasterRepo)
    {
        $this->linkMasterRepository = $linkMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/linkMasters",
     *      summary="Get a listing of the Link_masters.",
     *      tags={"Link_master"},
     *      description="Get all Link_masters",
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
     *                  @SWG\Items(ref="#/definitions/Link_master")
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
        /*$linkMasters = $this->linkMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Link_masterResource::collection($linkMasters), 'Link Masters retrieved successfully');*/

        $linkMasters = Link_master::get();
        if($linkMasters != ''){
            return response(['success'=>'true','Message'=>'Link Masters retrieved successfully.','linkMasters' => $linkMasters]);
        }else{
            return response(['success'=>'false','Message'=>"Link Masters Not Found"]);
        }
    }

    /**
     * @param CreateLink_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/linkMasters",
     *      summary="Store a newly created Link_master in storage",
     *      tags={"Link_master"},
     *      description="Store Link_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Link_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Link_master")
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
     *                  ref="#/definitions/Link_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLink_masterAPIRequest $request)
    {
        $input = $request->all();

        $linkMaster = $this->linkMasterRepository->create($input);

        return $this->sendResponse(new Link_masterResource($linkMaster), 'Link Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/linkMasters/{id}",
     *      summary="Display the specified Link_master",
     *      tags={"Link_master"},
     *      description="Get Link_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Link_master",
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
     *                  ref="#/definitions/Link_master"
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
        /** @var Link_master $linkMaster */
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            return $this->sendError('Link Master not found');
        }

        return $this->sendResponse(new Link_masterResource($linkMaster), 'Link Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLink_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/linkMasters/{id}",
     *      summary="Update the specified Link_master in storage",
     *      tags={"Link_master"},
     *      description="Update Link_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Link_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Link_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Link_master")
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
     *                  ref="#/definitions/Link_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLink_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Link_master $linkMaster */
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            return $this->sendError('Link Master not found');
        }

        $linkMaster = $this->linkMasterRepository->update($input, $id);

        return $this->sendResponse(new Link_masterResource($linkMaster), 'Link_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/linkMasters/{id}",
     *      summary="Remove the specified Link_master from storage",
     *      tags={"Link_master"},
     *      description="Delete Link_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Link_master",
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
        /** @var Link_master $linkMaster */
        $linkMaster = $this->linkMasterRepository->find($id);

        if (empty($linkMaster)) {
            return $this->sendError('Link Master not found');
        }

        $linkMaster->delete();

        return $this->sendSuccess('Link Master deleted successfully');
    }
}
