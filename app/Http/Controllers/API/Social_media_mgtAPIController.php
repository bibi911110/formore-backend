<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSocial_media_mgtAPIRequest;
use App\Http\Requests\API\UpdateSocial_media_mgtAPIRequest;
use App\Models\Social_media_mgt;
use App\Repositories\Social_media_mgtRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Social_media_mgtResource;
use Response;

/**
 * Class Social_media_mgtController
 * @package App\Http\Controllers\API
 */

class Social_media_mgtAPIController extends AppBaseController
{
    /** @var  Social_media_mgtRepository */
    private $socialMediaMgtRepository;

    public function __construct(Social_media_mgtRepository $socialMediaMgtRepo)
    {
        $this->socialMediaMgtRepository = $socialMediaMgtRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/socialMediaMgts",
     *      summary="Get a listing of the Social_media_mgts.",
     *      tags={"Social_media_mgt"},
     *      description="Get all Social_media_mgts",
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
     *                  @SWG\Items(ref="#/definitions/Social_media_mgt")
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
        $socialMediaMgts = $this->socialMediaMgtRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Social_media_mgtResource::collection($socialMediaMgts), 'Social Media Mgts retrieved successfully');
    }

    /**
     * @param CreateSocial_media_mgtAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/socialMediaMgts",
     *      summary="Store a newly created Social_media_mgt in storage",
     *      tags={"Social_media_mgt"},
     *      description="Store Social_media_mgt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Social_media_mgt that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Social_media_mgt")
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
     *                  ref="#/definitions/Social_media_mgt"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSocial_media_mgtAPIRequest $request)
    {
        $input = $request->all();

        $socialMediaMgt = $this->socialMediaMgtRepository->create($input);

        return $this->sendResponse(new Social_media_mgtResource($socialMediaMgt), 'Social Media Mgt saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/socialMediaMgts/{id}",
     *      summary="Display the specified Social_media_mgt",
     *      tags={"Social_media_mgt"},
     *      description="Get Social_media_mgt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Social_media_mgt",
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
     *                  ref="#/definitions/Social_media_mgt"
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
        /** @var Social_media_mgt $socialMediaMgt */
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            return $this->sendError('Social Media Mgt not found');
        }

        return $this->sendResponse(new Social_media_mgtResource($socialMediaMgt), 'Social Media Mgt retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSocial_media_mgtAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/socialMediaMgts/{id}",
     *      summary="Update the specified Social_media_mgt in storage",
     *      tags={"Social_media_mgt"},
     *      description="Update Social_media_mgt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Social_media_mgt",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Social_media_mgt that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Social_media_mgt")
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
     *                  ref="#/definitions/Social_media_mgt"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSocial_media_mgtAPIRequest $request)
    {
        $input = $request->all();

        /** @var Social_media_mgt $socialMediaMgt */
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            return $this->sendError('Social Media Mgt not found');
        }

        $socialMediaMgt = $this->socialMediaMgtRepository->update($input, $id);

        return $this->sendResponse(new Social_media_mgtResource($socialMediaMgt), 'Social_media_mgt updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/socialMediaMgts/{id}",
     *      summary="Remove the specified Social_media_mgt from storage",
     *      tags={"Social_media_mgt"},
     *      description="Delete Social_media_mgt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Social_media_mgt",
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
        /** @var Social_media_mgt $socialMediaMgt */
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            return $this->sendError('Social Media Mgt not found');
        }

        $socialMediaMgt->delete();

        return $this->sendSuccess('Social Media Mgt deleted successfully');
    }
}
