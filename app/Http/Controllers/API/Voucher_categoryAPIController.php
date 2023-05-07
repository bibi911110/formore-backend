<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVoucher_categoryAPIRequest;
use App\Http\Requests\API\UpdateVoucher_categoryAPIRequest;
use App\Models\Voucher_category;
use App\Repositories\Voucher_categoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Voucher_categoryResource;
use Response;

/**
 * Class Voucher_categoryController
 * @package App\Http\Controllers\API
 */

class Voucher_categoryAPIController extends AppBaseController
{
    /** @var  Voucher_categoryRepository */
    private $voucherCategoryRepository;

    public function __construct(Voucher_categoryRepository $voucherCategoryRepo)
    {
        $this->voucherCategoryRepository = $voucherCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/voucherCategories",
     *      summary="Get a listing of the Voucher_categories.",
     *      tags={"Voucher_category"},
     *      description="Get all Voucher_categories",
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
     *                  @SWG\Items(ref="#/definitions/Voucher_category")
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
        $voucherCategories = $this->voucherCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Voucher_categoryResource::collection($voucherCategories), 'Voucher Categories retrieved successfully');
    }

    /**
     * @param CreateVoucher_categoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/voucherCategories",
     *      summary="Store a newly created Voucher_category in storage",
     *      tags={"Voucher_category"},
     *      description="Store Voucher_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher_category that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher_category")
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
     *                  ref="#/definitions/Voucher_category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVoucher_categoryAPIRequest $request)
    {
        $input = $request->all();

        $voucherCategory = $this->voucherCategoryRepository->create($input);

        return $this->sendResponse(new Voucher_categoryResource($voucherCategory), 'Voucher Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/voucherCategories/{id}",
     *      summary="Display the specified Voucher_category",
     *      tags={"Voucher_category"},
     *      description="Get Voucher_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher_category",
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
     *                  ref="#/definitions/Voucher_category"
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
        /** @var Voucher_category $voucherCategory */
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            return $this->sendError('Voucher Category not found');
        }

        return $this->sendResponse(new Voucher_categoryResource($voucherCategory), 'Voucher Category retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVoucher_categoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/voucherCategories/{id}",
     *      summary="Update the specified Voucher_category in storage",
     *      tags={"Voucher_category"},
     *      description="Update Voucher_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher_category",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher_category that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher_category")
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
     *                  ref="#/definitions/Voucher_category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVoucher_categoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Voucher_category $voucherCategory */
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            return $this->sendError('Voucher Category not found');
        }

        $voucherCategory = $this->voucherCategoryRepository->update($input, $id);

        return $this->sendResponse(new Voucher_categoryResource($voucherCategory), 'Voucher_category updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/voucherCategories/{id}",
     *      summary="Remove the specified Voucher_category from storage",
     *      tags={"Voucher_category"},
     *      description="Delete Voucher_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher_category",
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
        /** @var Voucher_category $voucherCategory */
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            return $this->sendError('Voucher Category not found');
        }

        $voucherCategory->delete();

        return $this->sendSuccess('Voucher Category deleted successfully');
    }
}
