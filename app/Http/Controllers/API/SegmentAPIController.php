<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSegmentAPIRequest;
use App\Http\Requests\API\UpdateSegmentAPIRequest;
use App\Models\Segment;
use App\Repositories\SegmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\SegmentResource;
use Response;

/**
 * Class SegmentController
 * @package App\Http\Controllers\API
 */

class SegmentAPIController extends AppBaseController
{
    /** @var  SegmentRepository */
    private $segmentRepository;

    public function __construct(SegmentRepository $segmentRepo)
    {
        $this->segmentRepository = $segmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/segments",
     *      summary="Get a listing of the Segments.",
     *      tags={"Segment"},
     *      description="Get all Segments",
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
     *                  @SWG\Items(ref="#/definitions/Segment")
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
        /*$segments = $this->segmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );*/

        $segments = Segment::where('status',1)->get();

        return $this->sendResponse(SegmentResource::collection($segments), 'Segments retrieved successfully');
    }

    /**
     * @param CreateSegmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/segments",
     *      summary="Store a newly created Segment in storage",
     *      tags={"Segment"},
     *      description="Store Segment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Segment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Segment")
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
     *                  ref="#/definitions/Segment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSegmentAPIRequest $request)
    {
        $input = $request->all();

        $segment = $this->segmentRepository->create($input);

        return $this->sendResponse(new SegmentResource($segment), 'Segment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/segments/{id}",
     *      summary="Display the specified Segment",
     *      tags={"Segment"},
     *      description="Get Segment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Segment",
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
     *                  ref="#/definitions/Segment"
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
        /** @var Segment $segment */
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            return $this->sendError('Segment not found');
        }

        return $this->sendResponse(new SegmentResource($segment), 'Segment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSegmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/segments/{id}",
     *      summary="Update the specified Segment in storage",
     *      tags={"Segment"},
     *      description="Update Segment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Segment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Segment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Segment")
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
     *                  ref="#/definitions/Segment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSegmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Segment $segment */
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            return $this->sendError('Segment not found');
        }

        $segment = $this->segmentRepository->update($input, $id);

        return $this->sendResponse(new SegmentResource($segment), 'Segment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/segments/{id}",
     *      summary="Remove the specified Segment from storage",
     *      tags={"Segment"},
     *      description="Delete Segment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Segment",
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
        /** @var Segment $segment */
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            return $this->sendError('Segment not found');
        }

        $segment->delete();

        return $this->sendSuccess('Segment deleted successfully');
    }
}
