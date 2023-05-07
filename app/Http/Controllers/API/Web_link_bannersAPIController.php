<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWeb_link_bannersAPIRequest;
use App\Http\Requests\API\UpdateWeb_link_bannersAPIRequest;
use App\Models\Web_link_banners;
use App\Repositories\Web_link_bannersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Web_link_bannersResource;
use Response;

/**
 * Class Web_link_bannersController
 * @package App\Http\Controllers\API
 */

class Web_link_bannersAPIController extends AppBaseController
{
    /** @var  Web_link_bannersRepository */
    private $webLinkBannersRepository;

    public function __construct(Web_link_bannersRepository $webLinkBannersRepo)
    {
        $this->webLinkBannersRepository = $webLinkBannersRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/webLinkBanners",
     *      summary="Get a listing of the Web_link_banners.",
     *      tags={"Web_link_banners"},
     *      description="Get all Web_link_banners",
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
     *                  @SWG\Items(ref="#/definitions/Web_link_banners")
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
        $webLinkBanners = $this->webLinkBannersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Web_link_bannersResource::collection($webLinkBanners), 'Web Link Banners retrieved successfully');
    }

    /**
     * @param CreateWeb_link_bannersAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/webLinkBanners",
     *      summary="Store a newly created Web_link_banners in storage",
     *      tags={"Web_link_banners"},
     *      description="Store Web_link_banners",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Web_link_banners that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Web_link_banners")
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
     *                  ref="#/definitions/Web_link_banners"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWeb_link_bannersAPIRequest $request)
    {
        $input = $request->all();

        $webLinkBanners = $this->webLinkBannersRepository->create($input);

        return $this->sendResponse(new Web_link_bannersResource($webLinkBanners), 'Web Link Banners saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/webLinkBanners/{id}",
     *      summary="Display the specified Web_link_banners",
     *      tags={"Web_link_banners"},
     *      description="Get Web_link_banners",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Web_link_banners",
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
     *                  ref="#/definitions/Web_link_banners"
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
        /** @var Web_link_banners $webLinkBanners */
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            return $this->sendError('Web Link Banners not found');
        }

        return $this->sendResponse(new Web_link_bannersResource($webLinkBanners), 'Web Link Banners retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateWeb_link_bannersAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/webLinkBanners/{id}",
     *      summary="Update the specified Web_link_banners in storage",
     *      tags={"Web_link_banners"},
     *      description="Update Web_link_banners",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Web_link_banners",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Web_link_banners that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Web_link_banners")
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
     *                  ref="#/definitions/Web_link_banners"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWeb_link_bannersAPIRequest $request)
    {
        $input = $request->all();

        /** @var Web_link_banners $webLinkBanners */
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            return $this->sendError('Web Link Banners not found');
        }

        $webLinkBanners = $this->webLinkBannersRepository->update($input, $id);

        return $this->sendResponse(new Web_link_bannersResource($webLinkBanners), 'Web_link_banners updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/webLinkBanners/{id}",
     *      summary="Remove the specified Web_link_banners from storage",
     *      tags={"Web_link_banners"},
     *      description="Delete Web_link_banners",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Web_link_banners",
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
        /** @var Web_link_banners $webLinkBanners */
        $webLinkBanners = $this->webLinkBannersRepository->find($id);

        if (empty($webLinkBanners)) {
            return $this->sendError('Web Link Banners not found');
        }

        $webLinkBanners->delete();

        return $this->sendSuccess('Web Link Banners deleted successfully');
    }
}
