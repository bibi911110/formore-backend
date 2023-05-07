<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGallery_masterAPIRequest;
use App\Http\Requests\API\UpdateGallery_masterAPIRequest;
use App\Models\Gallery_master;
use App\Repositories\Gallery_masterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Gallery_masterResource;
use Response;

/**
 * Class Gallery_masterController
 * @package App\Http\Controllers\API
 */

class Gallery_masterAPIController extends AppBaseController
{
    /** @var  Gallery_masterRepository */
    private $galleryMasterRepository;

    public function __construct(Gallery_masterRepository $galleryMasterRepo)
    {
        $this->galleryMasterRepository = $galleryMasterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/galleryMasters",
     *      summary="Get a listing of the Gallery_masters.",
     *      tags={"Gallery_master"},
     *      description="Get all Gallery_masters",
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
     *                  @SWG\Items(ref="#/definitions/Gallery_master")
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
        $galleryMasters = $this->galleryMasterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Gallery_masterResource::collection($galleryMasters), 'Gallery Masters retrieved successfully');
    }

    /**
     * @param CreateGallery_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/galleryMasters",
     *      summary="Store a newly created Gallery_master in storage",
     *      tags={"Gallery_master"},
     *      description="Store Gallery_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gallery_master that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gallery_master")
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
     *                  ref="#/definitions/Gallery_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGallery_masterAPIRequest $request)
    {
        $input = $request->all();

        $galleryMaster = $this->galleryMasterRepository->create($input);

        return $this->sendResponse(new Gallery_masterResource($galleryMaster), 'Gallery Master saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/galleryMasters/{id}",
     *      summary="Display the specified Gallery_master",
     *      tags={"Gallery_master"},
     *      description="Get Gallery_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gallery_master",
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
     *                  ref="#/definitions/Gallery_master"
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
        /** @var Gallery_master $galleryMaster */
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            return $this->sendError('Gallery Master not found');
        }

        return $this->sendResponse(new Gallery_masterResource($galleryMaster), 'Gallery Master retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGallery_masterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/galleryMasters/{id}",
     *      summary="Update the specified Gallery_master in storage",
     *      tags={"Gallery_master"},
     *      description="Update Gallery_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gallery_master",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gallery_master that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gallery_master")
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
     *                  ref="#/definitions/Gallery_master"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGallery_masterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Gallery_master $galleryMaster */
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            return $this->sendError('Gallery Master not found');
        }

        $galleryMaster = $this->galleryMasterRepository->update($input, $id);

        return $this->sendResponse(new Gallery_masterResource($galleryMaster), 'Gallery_master updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/galleryMasters/{id}",
     *      summary="Remove the specified Gallery_master from storage",
     *      tags={"Gallery_master"},
     *      description="Delete Gallery_master",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gallery_master",
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
        /** @var Gallery_master $galleryMaster */
        $galleryMaster = $this->galleryMasterRepository->find($id);

        if (empty($galleryMaster)) {
            return $this->sendError('Gallery Master not found');
        }

        $galleryMaster->delete();

        return $this->sendSuccess('Gallery Master deleted successfully');
    }
}
