<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSub_categoryAPIRequest;
use App\Http\Requests\API\UpdateSub_categoryAPIRequest;
use App\Models\Sub_category;
use App\Repositories\Sub_categoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Sub_categoryResource;
use Response;

/**
 * Class Sub_categoryController
 * @package App\Http\Controllers\API
 */

class Sub_categoryAPIController extends AppBaseController
{
    /** @var  Sub_categoryRepository */
    private $subCategoryRepository;

    public function __construct(Sub_categoryRepository $subCategoryRepo)
    {
        $this->subCategoryRepository = $subCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/subCategories",
     *      summary="Get a listing of the Sub_categories.",
     *      tags={"Sub_category"},
     *      description="Get all Sub_categories",
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
     *                  @SWG\Items(ref="#/definitions/Sub_category")
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
       /* $subCategories = $this->subCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Sub_categoryResource::collection($subCategories), 'Sub Categories retrieved successfully');*/
        $subCategories = Sub_category::where('status',1)->get();
        if($subCategories != ''){
            return response(['status'=>'200','Message'=>'Sub Categories retrieved successfully.','subCategories' => $subCategories]);
        }else{
            return response(['status'=>'401','Message'=>"Sub Categories Not Found"]);
        }
    }

    /**
     * @param CreateSub_categoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/subCategories",
     *      summary="Store a newly created Sub_category in storage",
     *      tags={"Sub_category"},
     *      description="Store Sub_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Sub_category that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Sub_category")
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
     *                  ref="#/definitions/Sub_category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSub_categoryAPIRequest $request)
    {
        $input = $request->all();

        $subCategory = $this->subCategoryRepository->create($input);

        return $this->sendResponse(new Sub_categoryResource($subCategory), 'Sub Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/subCategories/{id}",
     *      summary="Display the specified Sub_category",
     *      tags={"Sub_category"},
     *      description="Get Sub_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sub_category",
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
     *                  ref="#/definitions/Sub_category"
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
        /** @var Sub_category $subCategory */
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            return $this->sendError('Sub Category not found');
        }

        return $this->sendResponse(new Sub_categoryResource($subCategory), 'Sub Category retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSub_categoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/subCategories/{id}",
     *      summary="Update the specified Sub_category in storage",
     *      tags={"Sub_category"},
     *      description="Update Sub_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sub_category",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Sub_category that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Sub_category")
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
     *                  ref="#/definitions/Sub_category"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSub_categoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sub_category $subCategory */
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            return $this->sendError('Sub Category not found');
        }

        $subCategory = $this->subCategoryRepository->update($input, $id);

        return $this->sendResponse(new Sub_categoryResource($subCategory), 'Sub_category updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/subCategories/{id}",
     *      summary="Remove the specified Sub_category from storage",
     *      tags={"Sub_category"},
     *      description="Delete Sub_category",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Sub_category",
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
        /** @var Sub_category $subCategory */
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            return $this->sendError('Sub Category not found');
        }

        $subCategory->delete();

        return $this->sendSuccess('Sub Category deleted successfully');
    }
}
