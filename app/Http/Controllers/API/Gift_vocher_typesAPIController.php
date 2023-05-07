<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGift_vocher_typesAPIRequest;
use App\Http\Requests\API\UpdateGift_vocher_typesAPIRequest;
use App\Models\Gift_vocher_types;
use App\Repositories\Gift_vocher_typesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Gift_vocher_typesResource;
use Response;

/**
 * Class Gift_vocher_typesController
 * @package App\Http\Controllers\API
 */

class Gift_vocher_typesAPIController extends AppBaseController
{
    /** @var  Gift_vocher_typesRepository */
    private $giftVocherTypesRepository;

    public function __construct(Gift_vocher_typesRepository $giftVocherTypesRepo)
    {
        $this->giftVocherTypesRepository = $giftVocherTypesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/giftVocherTypes",
     *      summary="Get a listing of the Gift_vocher_types.",
     *      tags={"Gift_vocher_types"},
     *      description="Get all Gift_vocher_types",
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
     *                  @SWG\Items(ref="#/definitions/Gift_vocher_types")
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
        $giftVocherTypes = $this->giftVocherTypesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Gift_vocher_typesResource::collection($giftVocherTypes), 'Gift Vocher Types retrieved successfully');
    }

    /**
     * @param CreateGift_vocher_typesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/giftVocherTypes",
     *      summary="Store a newly created Gift_vocher_types in storage",
     *      tags={"Gift_vocher_types"},
     *      description="Store Gift_vocher_types",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gift_vocher_types that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gift_vocher_types")
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
     *                  ref="#/definitions/Gift_vocher_types"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGift_vocher_typesAPIRequest $request)
    {
        $input = $request->all();

        $giftVocherTypes = $this->giftVocherTypesRepository->create($input);

        return $this->sendResponse(new Gift_vocher_typesResource($giftVocherTypes), 'Gift Vocher Types saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/giftVocherTypes/{id}",
     *      summary="Display the specified Gift_vocher_types",
     *      tags={"Gift_vocher_types"},
     *      description="Get Gift_vocher_types",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gift_vocher_types",
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
     *                  ref="#/definitions/Gift_vocher_types"
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
        /** @var Gift_vocher_types $giftVocherTypes */
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            return $this->sendError('Gift Vocher Types not found');
        }

        return $this->sendResponse(new Gift_vocher_typesResource($giftVocherTypes), 'Gift Vocher Types retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGift_vocher_typesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/giftVocherTypes/{id}",
     *      summary="Update the specified Gift_vocher_types in storage",
     *      tags={"Gift_vocher_types"},
     *      description="Update Gift_vocher_types",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gift_vocher_types",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gift_vocher_types that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gift_vocher_types")
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
     *                  ref="#/definitions/Gift_vocher_types"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGift_vocher_typesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Gift_vocher_types $giftVocherTypes */
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            return $this->sendError('Gift Vocher Types not found');
        }

        $giftVocherTypes = $this->giftVocherTypesRepository->update($input, $id);

        return $this->sendResponse(new Gift_vocher_typesResource($giftVocherTypes), 'Gift_vocher_types updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/giftVocherTypes/{id}",
     *      summary="Remove the specified Gift_vocher_types from storage",
     *      tags={"Gift_vocher_types"},
     *      description="Delete Gift_vocher_types",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gift_vocher_types",
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
        /** @var Gift_vocher_types $giftVocherTypes */
        $giftVocherTypes = $this->giftVocherTypesRepository->find($id);

        if (empty($giftVocherTypes)) {
            return $this->sendError('Gift Vocher Types not found');
        }

        $giftVocherTypes->delete();

        return $this->sendSuccess('Gift Vocher Types deleted successfully');
    }
}
