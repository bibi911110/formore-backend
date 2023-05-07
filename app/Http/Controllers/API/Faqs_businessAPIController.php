<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqs_businessAPIRequest;
use App\Http\Requests\API\UpdateFaqs_businessAPIRequest;
use App\Models\Faqs_business;
use App\Repositories\Faqs_businessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Faqs_businessResource;
use Response;

/**
 * Class Faqs_businessController
 * @package App\Http\Controllers\API
 */

class Faqs_businessAPIController extends AppBaseController
{
    /** @var  Faqs_businessRepository */
    private $faqsBusinessRepository;

    public function __construct(Faqs_businessRepository $faqsBusinessRepo)
    {
        $this->faqsBusinessRepository = $faqsBusinessRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/faqsBusinesses",
     *      summary="Get a listing of the Faqs_businesses.",
     *      tags={"Faqs_business"},
     *      description="Get all Faqs_businesses",
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
     *                  @SWG\Items(ref="#/definitions/Faqs_business")
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
        $faqsBusinesses = $this->faqsBusinessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Faqs_businessResource::collection($faqsBusinesses), 'Faqs Businesses retrieved successfully');
    }

    /**
     * @param CreateFaqs_businessAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/faqsBusinesses",
     *      summary="Store a newly created Faqs_business in storage",
     *      tags={"Faqs_business"},
     *      description="Store Faqs_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Faqs_business that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Faqs_business")
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
     *                  ref="#/definitions/Faqs_business"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFaqs_businessAPIRequest $request)
    {
        $input = $request->all();

        $faqsBusiness = $this->faqsBusinessRepository->create($input);

        return $this->sendResponse(new Faqs_businessResource($faqsBusiness), 'Faqs Business saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/faqsBusinesses/{id}",
     *      summary="Display the specified Faqs_business",
     *      tags={"Faqs_business"},
     *      description="Get Faqs_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Faqs_business",
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
     *                  ref="#/definitions/Faqs_business"
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
        /** @var Faqs_business $faqsBusiness */
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            return $this->sendError('Faqs Business not found');
        }

        return $this->sendResponse(new Faqs_businessResource($faqsBusiness), 'Faqs Business retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFaqs_businessAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/faqsBusinesses/{id}",
     *      summary="Update the specified Faqs_business in storage",
     *      tags={"Faqs_business"},
     *      description="Update Faqs_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Faqs_business",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Faqs_business that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Faqs_business")
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
     *                  ref="#/definitions/Faqs_business"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFaqs_businessAPIRequest $request)
    {
        $input = $request->all();

        /** @var Faqs_business $faqsBusiness */
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            return $this->sendError('Faqs Business not found');
        }

        $faqsBusiness = $this->faqsBusinessRepository->update($input, $id);

        return $this->sendResponse(new Faqs_businessResource($faqsBusiness), 'Faqs_business updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/faqsBusinesses/{id}",
     *      summary="Remove the specified Faqs_business from storage",
     *      tags={"Faqs_business"},
     *      description="Delete Faqs_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Faqs_business",
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
        /** @var Faqs_business $faqsBusiness */
        $faqsBusiness = $this->faqsBusinessRepository->find($id);

        if (empty($faqsBusiness)) {
            return $this->sendError('Faqs Business not found');
        }

        $faqsBusiness->delete();

        return $this->sendSuccess('Faqs Business deleted successfully');
    }
}
