<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRefer_business_detailsAPIRequest;
use App\Http\Requests\API\UpdateRefer_business_detailsAPIRequest;
use App\Models\Refer_business_details;
use App\Repositories\Refer_business_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Refer_business_detailsResource;
use Response;
use App\User;
use App\Helper\Email_master;


/**
 * Class Refer_business_detailsController
 * @package App\Http\Controllers\API
 */

class Refer_business_detailsAPIController extends AppBaseController
{
    /** @var  Refer_business_detailsRepository */
    private $referBusinessDetailsRepository;

    public function __construct(Refer_business_detailsRepository $referBusinessDetailsRepo)
    {
        $this->referBusinessDetailsRepository = $referBusinessDetailsRepo;
    }


    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/referBusinessDetails",
     *      summary="Get a listing of the Refer_business_details.",
     *      tags={"Refer_business_details"},
     *      description="Get all Refer_business_details",
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
     *                  @SWG\Items(ref="#/definitions/Refer_business_details")
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
        $referBusinessDetails = $this->referBusinessDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Refer_business_detailsResource::collection($referBusinessDetails), 'Refer Business Details retrieved successfully');
    }

    /**
     * @param CreateRefer_business_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/referBusinessDetails",
     *      summary="Store a newly created Refer_business_details in storage",
     *      tags={"Refer_business_details"},
     *      description="Store Refer_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Refer_business_details that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Refer_business_details")
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
     *                  ref="#/definitions/Refer_business_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRefer_business_detailsAPIRequest $request)
    {
        $input = $request->all();

        //$check = \App\User::where('email',$request->owner_email)->first();
        $check = Refer_business_details::where('owner_email',$request->owner_email)->first();
        if(!empty($check) && $check->owner_email != ''){

            return $this->sendResponse(new Refer_business_detailsResource($check), 'The business already exists');
        }else{

            $referBusinessDetails = $this->referBusinessDetailsRepository->create($input);
            $referDetails = $referBusinessDetails->toArray();
            $response = Email_master::send_email($referDetails);
         return $this->sendResponse(new Refer_business_detailsResource($referBusinessDetails), 'Your referral was successful');

        }


    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/referBusinessDetails/{id}",
     *      summary="Display the specified Refer_business_details",
     *      tags={"Refer_business_details"},
     *      description="Get Refer_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Refer_business_details",
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
     *                  ref="#/definitions/Refer_business_details"
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
        /** @var Refer_business_details $referBusinessDetails */
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            return $this->sendError('Refer Business Details not found');
        }

        return $this->sendResponse(new Refer_business_detailsResource($referBusinessDetails), 'Refer Business Details retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRefer_business_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/referBusinessDetails/{id}",
     *      summary="Update the specified Refer_business_details in storage",
     *      tags={"Refer_business_details"},
     *      description="Update Refer_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Refer_business_details",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Refer_business_details that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Refer_business_details")
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
     *                  ref="#/definitions/Refer_business_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRefer_business_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Refer_business_details $referBusinessDetails */
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            return $this->sendError('Refer Business Details not found');
        }

        $referBusinessDetails = $this->referBusinessDetailsRepository->update($input, $id);

        return $this->sendResponse(new Refer_business_detailsResource($referBusinessDetails), 'Refer_business_details updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/referBusinessDetails/{id}",
     *      summary="Remove the specified Refer_business_details from storage",
     *      tags={"Refer_business_details"},
     *      description="Delete Refer_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Refer_business_details",
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
        /** @var Refer_business_details $referBusinessDetails */
        $referBusinessDetails = $this->referBusinessDetailsRepository->find($id);

        if (empty($referBusinessDetails)) {
            return $this->sendError('Refer Business Details not found');
        }

        $referBusinessDetails->delete();

        return $this->sendSuccess('Refer Business Details deleted successfully');
    }


}
