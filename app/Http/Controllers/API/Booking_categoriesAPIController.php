<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBooking_categoriesAPIRequest;
use App\Http\Requests\API\UpdateBooking_categoriesAPIRequest;
use App\Models\Booking_categories;
use App\Repositories\Booking_categoriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Booking_categoriesResource;
use Response;

/**
 * Class Booking_categoriesController
 * @package App\Http\Controllers\API
 */

class Booking_categoriesAPIController extends AppBaseController
{
    /** @var  Booking_categoriesRepository */
    private $bookingCategoriesRepository;

    public function __construct(Booking_categoriesRepository $bookingCategoriesRepo)
    {
        $this->bookingCategoriesRepository = $bookingCategoriesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/bookingCategories",
     *      summary="Get a listing of the Booking_categories.",
     *      tags={"Booking_categories"},
     *      description="Get all Booking_categories",
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
     *                  @SWG\Items(ref="#/definitions/Booking_categories")
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
        $bookingCategories = $this->bookingCategoriesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Booking_categoriesResource::collection($bookingCategories), 'Booking Categories retrieved successfully');
    }

    public function booking_categories_business_wise(Request $request)
    {
        $categories = Booking_categories::where('status',1)->where('created_by',$request->business_id)->get();
        $new[] = array('id' => '0',"name" =>'All');
        foreach ($categories as  $value) {

                $new[] = array('id' => $value['id'],"name" =>$value['name'],"created_by" => $value['created_by'],'status' => $value['status'],"created_at" => $value['created_at'],"updated_at" => $value['updated_at'],"deleted_at" => $value['deleted_at']);      
        

        }

        if($new != ''){
            return response(['status'=>'200','Message'=>'Categories retrieved successfully.','categories' => $new]);

        }else{
            return response(['status'=>'401','Message'=>"Categories Not Found"]);

        }
    }

    /**
     * @param CreateBooking_categoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/bookingCategories",
     *      summary="Store a newly created Booking_categories in storage",
     *      tags={"Booking_categories"},
     *      description="Store Booking_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Booking_categories that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Booking_categories")
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
     *                  ref="#/definitions/Booking_categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBooking_categoriesAPIRequest $request)
    {
        $input = $request->all();

        $bookingCategories = $this->bookingCategoriesRepository->create($input);

        return $this->sendResponse(new Booking_categoriesResource($bookingCategories), 'Booking Categories saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/bookingCategories/{id}",
     *      summary="Display the specified Booking_categories",
     *      tags={"Booking_categories"},
     *      description="Get Booking_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Booking_categories",
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
     *                  ref="#/definitions/Booking_categories"
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
        /** @var Booking_categories $bookingCategories */
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            return $this->sendError('Booking Categories not found');
        }

        return $this->sendResponse(new Booking_categoriesResource($bookingCategories), 'Booking Categories retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBooking_categoriesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/bookingCategories/{id}",
     *      summary="Update the specified Booking_categories in storage",
     *      tags={"Booking_categories"},
     *      description="Update Booking_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Booking_categories",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Booking_categories that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Booking_categories")
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
     *                  ref="#/definitions/Booking_categories"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBooking_categoriesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Booking_categories $bookingCategories */
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            return $this->sendError('Booking Categories not found');
        }

        $bookingCategories = $this->bookingCategoriesRepository->update($input, $id);

        return $this->sendResponse(new Booking_categoriesResource($bookingCategories), 'Booking_categories updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/bookingCategories/{id}",
     *      summary="Remove the specified Booking_categories from storage",
     *      tags={"Booking_categories"},
     *      description="Delete Booking_categories",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Booking_categories",
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
        /** @var Booking_categories $bookingCategories */
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            return $this->sendError('Booking Categories not found');
        }

        $bookingCategories->delete();

        return $this->sendSuccess('Booking Categories deleted successfully');
    }
}
