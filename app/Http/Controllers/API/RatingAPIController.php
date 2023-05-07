<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRatingAPIRequest;
use App\Http\Requests\API\UpdateRatingAPIRequest;
use App\Models\Rating;
use App\Repositories\RatingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RatingResource;
use Response;

/**
 * Class RatingController
 * @package App\Http\Controllers\API
 */

class RatingAPIController extends AppBaseController
{
    /** @var  RatingRepository */
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepository = $ratingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/ratings",
     *      summary="Get a listing of the Ratings.",
     *      tags={"Rating"},
     *      description="Get all Ratings",
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
     *                  @SWG\Items(ref="#/definitions/Rating")
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
        $ratings = $this->ratingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(RatingResource::collection($ratings), 'Ratings retrieved successfully');
    }

    public function ratings_view_id_wise(Request $request)
    {

        $Rating = Rating::where('status',1)->get();
        if($Rating != ''){
            return response(['status'=>'200','Message'=>'Rating retrieved successfully.','Rating' => $Rating]);
        }else{
            return response(['status'=>'401','Message'=>"Rating Not Found"]);
        }

    }

    /**
     * @param CreateRatingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/ratings",
     *      summary="Store a newly created Rating in storage",
     *      tags={"Rating"},
     *      description="Store Rating",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Rating that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Rating")
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
     *                  ref="#/definitions/Rating"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRatingAPIRequest $request)
    {
        $input = $request->all();

        $rating = $this->ratingRepository->create($input);

        return $this->sendResponse(new RatingResource($rating), 'Rating saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/ratings/{id}",
     *      summary="Display the specified Rating",
     *      tags={"Rating"},
     *      description="Get Rating",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rating",
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
     *                  ref="#/definitions/Rating"
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
        /** @var Rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        return $this->sendResponse(new RatingResource($rating), 'Rating retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRatingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/ratings/{id}",
     *      summary="Update the specified Rating in storage",
     *      tags={"Rating"},
     *      description="Update Rating",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rating",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Rating that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Rating")
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
     *                  ref="#/definitions/Rating"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRatingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating = $this->ratingRepository->update($input, $id);

        return $this->sendResponse(new RatingResource($rating), 'Rating updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/ratings/{id}",
     *      summary="Remove the specified Rating from storage",
     *      tags={"Rating"},
     *      description="Delete Rating",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rating",
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
        /** @var Rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating->delete();

        return $this->sendSuccess('Rating deleted successfully');
    }
}
