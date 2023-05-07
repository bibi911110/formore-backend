<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAbout_usAPIRequest;
use App\Http\Requests\API\UpdateAbout_usAPIRequest;
use App\Models\About_us;
use App\Repositories\About_usRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\About_usResource;
use Response;

/**
 * Class About_usController
 * @package App\Http\Controllers\API
 */

class About_usAPIController extends AppBaseController
{
    /** @var  About_usRepository */
    private $aboutUsRepository;

    public function __construct(About_usRepository $aboutUsRepo)
    {
        $this->aboutUsRepository = $aboutUsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/aboutUses",
     *      summary="Get a listing of the About_uses.",
     *      tags={"About_us"},
     *      description="Get all About_uses",
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
     *                  @SWG\Items(ref="#/definitions/About_us")
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
        $aboutUses = $this->aboutUsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(About_usResource::collection($aboutUses), 'About Uses retrieved successfully');
    }

    /**
     * @param CreateAbout_usAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/aboutUses",
     *      summary="Store a newly created About_us in storage",
     *      tags={"About_us"},
     *      description="Store About_us",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="About_us that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/About_us")
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
     *                  ref="#/definitions/About_us"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAbout_usAPIRequest $request)
    {
        $input = $request->all();

        $aboutUs = $this->aboutUsRepository->create($input);

        return $this->sendResponse(new About_usResource($aboutUs), 'About Us saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/aboutUses/{id}",
     *      summary="Display the specified About_us",
     *      tags={"About_us"},
     *      description="Get About_us",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of About_us",
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
     *                  ref="#/definitions/About_us"
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
        /** @var About_us $aboutUs */
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            return $this->sendError('About Us not found');
        }

        return $this->sendResponse(new About_usResource($aboutUs), 'About Us retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAbout_usAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/aboutUses/{id}",
     *      summary="Update the specified About_us in storage",
     *      tags={"About_us"},
     *      description="Update About_us",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of About_us",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="About_us that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/About_us")
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
     *                  ref="#/definitions/About_us"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAbout_usAPIRequest $request)
    {
        $input = $request->all();

        /** @var About_us $aboutUs */
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            return $this->sendError('About Us not found');
        }

        $aboutUs = $this->aboutUsRepository->update($input, $id);

        return $this->sendResponse(new About_usResource($aboutUs), 'About_us updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/aboutUses/{id}",
     *      summary="Remove the specified About_us from storage",
     *      tags={"About_us"},
     *      description="Delete About_us",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of About_us",
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
        /** @var About_us $aboutUs */
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            return $this->sendError('About Us not found');
        }

        $aboutUs->delete();

        return $this->sendSuccess('About Us deleted successfully');
    }
}
