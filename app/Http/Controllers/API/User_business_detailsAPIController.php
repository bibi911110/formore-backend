<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUser_business_detailsAPIRequest;
use App\Http\Requests\API\UpdateUser_business_detailsAPIRequest;
use App\Models\User_business_details;
use App\Repositories\User_business_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\User_business_detailsResource;
use Response;

/**
 * Class User_business_detailsController
 * @package App\Http\Controllers\API
 */

class User_business_detailsAPIController extends AppBaseController
{
    /** @var  User_business_detailsRepository */
    private $userBusinessDetailsRepository;

    public function __construct(User_business_detailsRepository $userBusinessDetailsRepo)
    {
        $this->userBusinessDetailsRepository = $userBusinessDetailsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/userBusinessDetails",
     *      summary="Get a listing of the User_business_details.",
     *      tags={"User_business_details"},
     *      description="Get all User_business_details",
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
     *                  @SWG\Items(ref="#/definitions/User_business_details")
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
        $userBusinessDetails = $this->userBusinessDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(User_business_detailsResource::collection($userBusinessDetails), 'User Business Details retrieved successfully');
    }

    /**
     * @param CreateUser_business_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/userBusinessDetails",
     *      summary="Store a newly created User_business_details in storage",
     *      tags={"User_business_details"},
     *      description="Store User_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User_business_details that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User_business_details")
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
     *                  ref="#/definitions/User_business_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUser_business_detailsAPIRequest $request)
    {
        $input = $request->all();

        $userBusinessDetails = $this->userBusinessDetailsRepository->create($input);

        return $this->sendResponse(new User_business_detailsResource($userBusinessDetails), 'User Business Details saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userBusinessDetails/{id}",
     *      summary="Display the specified User_business_details",
     *      tags={"User_business_details"},
     *      description="Get User_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User_business_details",
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
     *                  ref="#/definitions/User_business_details"
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
        /** @var User_business_details $userBusinessDetails */
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            return $this->sendError('User Business Details not found');
        }

        return $this->sendResponse(new User_business_detailsResource($userBusinessDetails), 'User Business Details retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUser_business_detailsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/userBusinessDetails/{id}",
     *      summary="Update the specified User_business_details in storage",
     *      tags={"User_business_details"},
     *      description="Update User_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User_business_details",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User_business_details that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User_business_details")
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
     *                  ref="#/definitions/User_business_details"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUser_business_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var User_business_details $userBusinessDetails */
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            return $this->sendError('User Business Details not found');
        }

        $userBusinessDetails = $this->userBusinessDetailsRepository->update($input, $id);

        return $this->sendResponse(new User_business_detailsResource($userBusinessDetails), 'User_business_details updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/userBusinessDetails/{id}",
     *      summary="Remove the specified User_business_details from storage",
     *      tags={"User_business_details"},
     *      description="Delete User_business_details",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User_business_details",
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
        /** @var User_business_details $userBusinessDetails */
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            return $this->sendError('User Business Details not found');
        }

        $userBusinessDetails->delete();

        return $this->sendSuccess('User Business Details deleted successfully');
    }
}
