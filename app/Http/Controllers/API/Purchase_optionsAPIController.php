<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePurchase_optionsAPIRequest;
use App\Http\Requests\API\UpdatePurchase_optionsAPIRequest;
use App\Models\Purchase_options;
use App\Repositories\Purchase_optionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Purchase_optionsResource;
use Response;

/**
 * Class Purchase_optionsController
 * @package App\Http\Controllers\API
 */

class Purchase_optionsAPIController extends AppBaseController
{
    /** @var  Purchase_optionsRepository */
    private $purchaseOptionsRepository;

    public function __construct(Purchase_optionsRepository $purchaseOptionsRepo)
    {
        $this->purchaseOptionsRepository = $purchaseOptionsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseOptions",
     *      summary="Get a listing of the Purchase_options.",
     *      tags={"Purchase_options"},
     *      description="Get all Purchase_options",
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
     *                  @SWG\Items(ref="#/definitions/Purchase_options")
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
        $purchaseOptions = $this->purchaseOptionsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Purchase_optionsResource::collection($purchaseOptions), 'Purchase Options retrieved successfully');
    }

    /**
     * @param CreatePurchase_optionsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/purchaseOptions",
     *      summary="Store a newly created Purchase_options in storage",
     *      tags={"Purchase_options"},
     *      description="Store Purchase_options",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Purchase_options that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Purchase_options")
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
     *                  ref="#/definitions/Purchase_options"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePurchase_optionsAPIRequest $request)
    {
        $input = $request->all();

        $purchaseOptions = $this->purchaseOptionsRepository->create($input);

        return $this->sendResponse(new Purchase_optionsResource($purchaseOptions), 'Purchase Options saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/purchaseOptions/{id}",
     *      summary="Display the specified Purchase_options",
     *      tags={"Purchase_options"},
     *      description="Get Purchase_options",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Purchase_options",
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
     *                  ref="#/definitions/Purchase_options"
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
        /** @var Purchase_options $purchaseOptions */
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            return $this->sendError('Purchase Options not found');
        }

        return $this->sendResponse(new Purchase_optionsResource($purchaseOptions), 'Purchase Options retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePurchase_optionsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/purchaseOptions/{id}",
     *      summary="Update the specified Purchase_options in storage",
     *      tags={"Purchase_options"},
     *      description="Update Purchase_options",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Purchase_options",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Purchase_options that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Purchase_options")
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
     *                  ref="#/definitions/Purchase_options"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePurchase_optionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Purchase_options $purchaseOptions */
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            return $this->sendError('Purchase Options not found');
        }

        $purchaseOptions = $this->purchaseOptionsRepository->update($input, $id);

        return $this->sendResponse(new Purchase_optionsResource($purchaseOptions), 'Purchase_options updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/purchaseOptions/{id}",
     *      summary="Remove the specified Purchase_options from storage",
     *      tags={"Purchase_options"},
     *      description="Delete Purchase_options",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Purchase_options",
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
        /** @var Purchase_options $purchaseOptions */
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            return $this->sendError('Purchase Options not found');
        }

        $purchaseOptions->delete();

        return $this->sendSuccess('Purchase Options deleted successfully');
    }
}
