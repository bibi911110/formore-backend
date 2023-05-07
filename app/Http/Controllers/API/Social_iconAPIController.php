<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSocial_iconAPIRequest;
use App\Http\Requests\API\UpdateSocial_iconAPIRequest;
use App\Models\Social_icon;
use App\Repositories\Social_iconRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Social_iconResource;
use Response;

/**
 * Class Social_iconController
 * @package App\Http\Controllers\API
 */

class Social_iconAPIController extends AppBaseController
{
    /** @var  Social_iconRepository */
    private $socialIconRepository;

    public function __construct(Social_iconRepository $socialIconRepo)
    {
        $this->socialIconRepository = $socialIconRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/socialIcons",
     *      summary="Get a listing of the Social_icons.",
     *      tags={"Social_icon"},
     *      description="Get all Social_icons",
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
     *                  @SWG\Items(ref="#/definitions/Social_icon")
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
        $socialIcons = $this->socialIconRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Social_iconResource::collection($socialIcons), 'Social Icons retrieved successfully');
    }

    /**
     * @param CreateSocial_iconAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/socialIcons",
     *      summary="Store a newly created Social_icon in storage",
     *      tags={"Social_icon"},
     *      description="Store Social_icon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Social_icon that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Social_icon")
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
     *                  ref="#/definitions/Social_icon"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSocial_iconAPIRequest $request)
    {
        $input = $request->all();

        $socialIcon = $this->socialIconRepository->create($input);

        return $this->sendResponse(new Social_iconResource($socialIcon), 'Social Icon saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/socialIcons/{id}",
     *      summary="Display the specified Social_icon",
     *      tags={"Social_icon"},
     *      description="Get Social_icon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Social_icon",
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
     *                  ref="#/definitions/Social_icon"
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
        /** @var Social_icon $socialIcon */
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            return $this->sendError('Social Icon not found');
        }

        return $this->sendResponse(new Social_iconResource($socialIcon), 'Social Icon retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSocial_iconAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/socialIcons/{id}",
     *      summary="Update the specified Social_icon in storage",
     *      tags={"Social_icon"},
     *      description="Update Social_icon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Social_icon",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Social_icon that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Social_icon")
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
     *                  ref="#/definitions/Social_icon"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSocial_iconAPIRequest $request)
    {
        $input = $request->all();

        /** @var Social_icon $socialIcon */
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            return $this->sendError('Social Icon not found');
        }

        $socialIcon = $this->socialIconRepository->update($input, $id);

        return $this->sendResponse(new Social_iconResource($socialIcon), 'Social_icon updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/socialIcons/{id}",
     *      summary="Remove the specified Social_icon from storage",
     *      tags={"Social_icon"},
     *      description="Delete Social_icon",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Social_icon",
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
        /** @var Social_icon $socialIcon */
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            return $this->sendError('Social Icon not found');
        }

        $socialIcon->delete();

        return $this->sendSuccess('Social Icon deleted successfully');
    }
}
