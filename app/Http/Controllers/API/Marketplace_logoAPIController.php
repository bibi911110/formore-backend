<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMarketplace_logoAPIRequest;
use App\Http\Requests\API\UpdateMarketplace_logoAPIRequest;
use App\Models\Marketplace_logo;
use App\Repositories\Marketplace_logoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Marketplace_logoResource;
use Response;

/**
 * Class Marketplace_logoController
 * @package App\Http\Controllers\API
 */

class Marketplace_logoAPIController extends AppBaseController
{
    /** @var  Marketplace_logoRepository */
    private $marketplaceLogoRepository;

    public function __construct(Marketplace_logoRepository $marketplaceLogoRepo)
    {
        $this->marketplaceLogoRepository = $marketplaceLogoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/marketplaceLogos",
     *      summary="Get a listing of the Marketplace_logos.",
     *      tags={"Marketplace_logo"},
     *      description="Get all Marketplace_logos",
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
     *                  @SWG\Items(ref="#/definitions/Marketplace_logo")
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
        /*$marketplaceLogos = $this->marketplaceLogoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Marketplace_logoResource::collection($marketplaceLogos), 'Marketplace Logos retrieved successfully');*/

        $marketplaceLogos = \App\Models\Marketplace_logo::leftjoin('brand','marketplace_logo.business_id','brand.id')
                                                    ->leftjoin('users','brand.id','users.userDetailsId')
                                                    ->orderBy('marketplace_logo.position','DESC')
                                                    ->select('brand.*','marketplace_logo.position','users.id as user_id')
                                                     ->get();
        if($marketplaceLogos != ''){
            return response(['status'=>'200','Message'=>'Marketplace Logos retrieved successfully.','marketplaceLogos' => $marketplaceLogos]);
        }else{
            return response(['status'=>'401','Message'=>"Marketplace Logos Not Found"]);
        }
    }

    /**
     * @param CreateMarketplace_logoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/marketplaceLogos",
     *      summary="Store a newly created Marketplace_logo in storage",
     *      tags={"Marketplace_logo"},
     *      description="Store Marketplace_logo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Marketplace_logo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Marketplace_logo")
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
     *                  ref="#/definitions/Marketplace_logo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMarketplace_logoAPIRequest $request)
    {
        $input = $request->all();

        $marketplaceLogo = $this->marketplaceLogoRepository->create($input);

        return $this->sendResponse(new Marketplace_logoResource($marketplaceLogo), 'Marketplace Logo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/marketplaceLogos/{id}",
     *      summary="Display the specified Marketplace_logo",
     *      tags={"Marketplace_logo"},
     *      description="Get Marketplace_logo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Marketplace_logo",
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
     *                  ref="#/definitions/Marketplace_logo"
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
        /** @var Marketplace_logo $marketplaceLogo */
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            return $this->sendError('Marketplace Logo not found');
        }

        return $this->sendResponse(new Marketplace_logoResource($marketplaceLogo), 'Marketplace Logo retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMarketplace_logoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/marketplaceLogos/{id}",
     *      summary="Update the specified Marketplace_logo in storage",
     *      tags={"Marketplace_logo"},
     *      description="Update Marketplace_logo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Marketplace_logo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Marketplace_logo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Marketplace_logo")
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
     *                  ref="#/definitions/Marketplace_logo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMarketplace_logoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Marketplace_logo $marketplaceLogo */
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            return $this->sendError('Marketplace Logo not found');
        }

        $marketplaceLogo = $this->marketplaceLogoRepository->update($input, $id);

        return $this->sendResponse(new Marketplace_logoResource($marketplaceLogo), 'Marketplace_logo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/marketplaceLogos/{id}",
     *      summary="Remove the specified Marketplace_logo from storage",
     *      tags={"Marketplace_logo"},
     *      description="Delete Marketplace_logo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Marketplace_logo",
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
        /** @var Marketplace_logo $marketplaceLogo */
        $marketplaceLogo = $this->marketplaceLogoRepository->find($id);

        if (empty($marketplaceLogo)) {
            return $this->sendError('Marketplace Logo not found');
        }

        $marketplaceLogo->delete();

        return $this->sendSuccess('Marketplace Logo deleted successfully');
    }
}
