<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServices_productAPIRequest;
use App\Http\Requests\API\UpdateServices_productAPIRequest;
use App\Models\Services_product;
use App\Repositories\Services_productRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Services_productResource;
use Response;

/**
 * Class Services_productController
 * @package App\Http\Controllers\API
 */

class Services_productAPIController extends AppBaseController
{
    /** @var  Services_productRepository */
    private $servicesProductRepository;

    public function __construct(Services_productRepository $servicesProductRepo)
    {
        $this->servicesProductRepository = $servicesProductRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/servicesProducts",
     *      summary="Get a listing of the Services_products.",
     *      tags={"Services_product"},
     *      description="Get all Services_products",
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
     *                  @SWG\Items(ref="#/definitions/Services_product")
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
        $servicesProducts = $this->servicesProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Services_productResource::collection($servicesProducts), 'Services Products retrieved successfully');
    }

    public function booking_products_business_wise(Request $request)
    {
        if(!empty($request['cat_id']) && $request['cat_id'] != '')
        {
            $booking_products = Services_product::where('services_product.created_by',$request->business_id)
                                            ->where('services_product.cat_id',$request->cat_id)
                                            ->leftjoin('booking_categories','services_product.cat_id','booking_categories.id')
                                             ->leftjoin('users','services_product.created_by','users.id')
                                             ->leftjoin('brand','users.userDetailsId','brand.id')
                                             ->leftjoin('currency','brand.currency','currency.id')
                                            ->select('services_product.*','booking_categories.name as catName','currency.currency_code','currency.currency_name')
                                            ->get();
        $count = 0;
        foreach ($booking_products as $value) {

         $cart_extra_details = \App\Models\Extra_services::leftjoin('services_product','extra_services.product_id','services_product.id')
                                                ->where('extra_services.product_id',$value->id)
                                               ->select('extra_services.*','services_product.name as product_name')
                                               ->get();

        $booking_products[$count] = $value;
        $booking_products[$count]['extra_details'] = $cart_extra_details;
        $count++;


        }          
        }else{

            $booking_products = Services_product::where('services_product.created_by',$request->business_id)
                                           // ->where('services_product.cat_id',$request->cat_id)
                                            ->leftjoin('booking_categories','services_product.cat_id','booking_categories.id')
                                             ->leftjoin('users','services_product.created_by','users.id')
                                             ->leftjoin('brand','users.userDetailsId','brand.id')
                                             ->leftjoin('currency','brand.currency','currency.id')
                                            ->select('services_product.*','booking_categories.name as catName','currency.currency_code','currency.currency_name','users.userDetailsId')
                                            //->select('services_product.*','booking_categories.name as catName')
                                            ->get();
        $count = 0;
        foreach ($booking_products as $value) {

         $cart_extra_details = \App\Models\Extra_services::leftjoin('services_product','extra_services.product_id','services_product.id')
                                                ->where('extra_services.product_id',$value->id)
                                               ->select('extra_services.*','services_product.name as product_name')
                                               ->get();

        $booking_products[$count] = $value;
        $booking_products[$count]['extra_details'] = $cart_extra_details;
        $count++;


        }   

        }


        if($booking_products != ''){
            return response(['status'=>'200','Message'=>'Booking products retrieved successfully.','booking_products' => $booking_products]);

        }else{
            return response(['status'=>'401','Message'=>"Booking products Not Found"]);

        }
    }

    /**
     * @param CreateServices_productAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/servicesProducts",
     *      summary="Store a newly created Services_product in storage",
     *      tags={"Services_product"},
     *      description="Store Services_product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Services_product that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Services_product")
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
     *                  ref="#/definitions/Services_product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServices_productAPIRequest $request)
    {
        $input = $request->all();

        $servicesProduct = $this->servicesProductRepository->create($input);

        return $this->sendResponse(new Services_productResource($servicesProduct), 'Services Product saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/servicesProducts/{id}",
     *      summary="Display the specified Services_product",
     *      tags={"Services_product"},
     *      description="Get Services_product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Services_product",
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
     *                  ref="#/definitions/Services_product"
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
        /** @var Services_product $servicesProduct */
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            return $this->sendError('Services Product not found');
        }

        return $this->sendResponse(new Services_productResource($servicesProduct), 'Services Product retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateServices_productAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/servicesProducts/{id}",
     *      summary="Update the specified Services_product in storage",
     *      tags={"Services_product"},
     *      description="Update Services_product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Services_product",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Services_product that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Services_product")
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
     *                  ref="#/definitions/Services_product"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServices_productAPIRequest $request)
    {
        $input = $request->all();

        /** @var Services_product $servicesProduct */
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            return $this->sendError('Services Product not found');
        }

        $servicesProduct = $this->servicesProductRepository->update($input, $id);

        return $this->sendResponse(new Services_productResource($servicesProduct), 'Services_product updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/servicesProducts/{id}",
     *      summary="Remove the specified Services_product from storage",
     *      tags={"Services_product"},
     *      description="Delete Services_product",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Services_product",
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
        /** @var Services_product $servicesProduct */
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            return $this->sendError('Services Product not found');
        }

        $servicesProduct->delete();

        return $this->sendSuccess('Services Product deleted successfully');
    }
}
