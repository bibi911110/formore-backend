<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRefer_businessAPIRequest;
use App\Http\Requests\API\UpdateRefer_businessAPIRequest;
use App\Models\Refer_business;
use App\Repositories\Refer_businessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Refer_businessResource;
use Response;

/**
 * Class Refer_businessController
 * @package App\Http\Controllers\API
 */

class Refer_businessAPIController extends AppBaseController
{
    /** @var  Refer_businessRepository */
    private $referBusinessRepository;

    public function __construct(Refer_businessRepository $referBusinessRepo)
    {
        $this->referBusinessRepository = $referBusinessRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/referBusinesses",
     *      summary="Get a listing of the Refer_businesses.",
     *      tags={"Refer_business"},
     *      description="Get all Refer_businesses",
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
     *                  @SWG\Items(ref="#/definitions/Refer_business")
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
        $referBusinesses = Refer_business::where('status',1)->get();
        if($referBusinesses != ''){
            return response(['status'=>'200','Message'=>'Refer Businesses retrieved successfully.','referBusinesses' => $referBusinesses]);
        }else{
            return response(['status'=>'401','Message'=>"Refer Businesses Not Found"]);
        }
        
        /*$referBusinesses = $this->referBusinessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Refer_businessResource::collection($referBusinesses), 'Refer Businesses retrieved successfully');*/
    }

    /**
     * @param CreateRefer_businessAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/referBusinesses",
     *      summary="Store a newly created Refer_business in storage",
     *      tags={"Refer_business"},
     *      description="Store Refer_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Refer_business that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Refer_business")
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
     *                  ref="#/definitions/Refer_business"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRefer_businessAPIRequest $request)
    {
        $input = $request->all();

        $referBusiness = $this->referBusinessRepository->create($input);

        return $this->sendResponse(new Refer_businessResource($referBusiness), 'Refer Business saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/referBusinesses/{id}",
     *      summary="Display the specified Refer_business",
     *      tags={"Refer_business"},
     *      description="Get Refer_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Refer_business",
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
     *                  ref="#/definitions/Refer_business"
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
        /** @var Refer_business $referBusiness */
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            return $this->sendError('Refer Business not found');
        }

        return $this->sendResponse(new Refer_businessResource($referBusiness), 'Refer Business retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRefer_businessAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/referBusinesses/{id}",
     *      summary="Update the specified Refer_business in storage",
     *      tags={"Refer_business"},
     *      description="Update Refer_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Refer_business",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Refer_business that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Refer_business")
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
     *                  ref="#/definitions/Refer_business"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRefer_businessAPIRequest $request)
    {
        $input = $request->all();

        /** @var Refer_business $referBusiness */
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            return $this->sendError('Refer Business not found');
        }

        $referBusiness = $this->referBusinessRepository->update($input, $id);

        return $this->sendResponse(new Refer_businessResource($referBusiness), 'Refer_business updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/referBusinesses/{id}",
     *      summary="Remove the specified Refer_business from storage",
     *      tags={"Refer_business"},
     *      description="Delete Refer_business",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Refer_business",
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
        /** @var Refer_business $referBusiness */
        $referBusiness = $this->referBusinessRepository->find($id);

        if (empty($referBusiness)) {
            return $this->sendError('Refer Business not found');
        }

        $referBusiness->delete();

        return $this->sendSuccess('Refer Business deleted successfully');
    }
}
