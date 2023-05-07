<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFlag_selectionAPIRequest;
use App\Http\Requests\API\UpdateFlag_selectionAPIRequest;
use App\Models\Flag_selection;
use App\Repositories\Flag_selectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Flag_selectionResource;
use Response;

/**
 * Class Flag_selectionController
 * @package App\Http\Controllers\API
 */

class Flag_selectionAPIController extends AppBaseController
{
    /** @var  Flag_selectionRepository */
    private $flagSelectionRepository;

    public function __construct(Flag_selectionRepository $flagSelectionRepo)
    {
        $this->flagSelectionRepository = $flagSelectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/flagSelections",
     *      summary="Get a listing of the Flag_selections.",
     *      tags={"Flag_selection"},
     *      description="Get all Flag_selections",
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
     *                  @SWG\Items(ref="#/definitions/Flag_selection")
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
        $flagSelections = $this->flagSelectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Flag_selectionResource::collection($flagSelections), 'Flag Selections retrieved successfully');
    }

    /**
     * @param CreateFlag_selectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/flagSelections",
     *      summary="Store a newly created Flag_selection in storage",
     *      tags={"Flag_selection"},
     *      description="Store Flag_selection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Flag_selection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Flag_selection")
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
     *                  ref="#/definitions/Flag_selection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFlag_selectionAPIRequest $request)
    {
        $input = $request->all();

        $flagSelection = $this->flagSelectionRepository->create($input);

        return $this->sendResponse(new Flag_selectionResource($flagSelection), 'Flag Selection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/flagSelections/{id}",
     *      summary="Display the specified Flag_selection",
     *      tags={"Flag_selection"},
     *      description="Get Flag_selection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Flag_selection",
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
     *                  ref="#/definitions/Flag_selection"
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
        /** @var Flag_selection $flagSelection */
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            return $this->sendError('Flag Selection not found');
        }

        return $this->sendResponse(new Flag_selectionResource($flagSelection), 'Flag Selection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFlag_selectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/flagSelections/{id}",
     *      summary="Update the specified Flag_selection in storage",
     *      tags={"Flag_selection"},
     *      description="Update Flag_selection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Flag_selection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Flag_selection that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Flag_selection")
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
     *                  ref="#/definitions/Flag_selection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFlag_selectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Flag_selection $flagSelection */
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            return $this->sendError('Flag Selection not found');
        }

        $flagSelection = $this->flagSelectionRepository->update($input, $id);

        return $this->sendResponse(new Flag_selectionResource($flagSelection), 'Flag_selection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/flagSelections/{id}",
     *      summary="Remove the specified Flag_selection from storage",
     *      tags={"Flag_selection"},
     *      description="Delete Flag_selection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Flag_selection",
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
        /** @var Flag_selection $flagSelection */
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            return $this->sendError('Flag Selection not found');
        }

        $flagSelection->delete();

        return $this->sendSuccess('Flag Selection deleted successfully');
    }
}
