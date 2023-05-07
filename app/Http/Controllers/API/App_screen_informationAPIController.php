<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApp_screen_informationAPIRequest;
use App\Http\Requests\API\UpdateApp_screen_informationAPIRequest;
use App\Models\App_screen_information;
use App\Repositories\App_screen_informationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\App_screen_informationResource;
use Response;

/**
 * Class App_screen_informationController
 * @package App\Http\Controllers\API
 */

class App_screen_informationAPIController extends AppBaseController
{
    /** @var  App_screen_informationRepository */
    private $appScreenInformationRepository;

    public function __construct(App_screen_informationRepository $appScreenInformationRepo)
    {
        $this->appScreenInformationRepository = $appScreenInformationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/appScreenInformations",
     *      summary="Get a listing of the App_screen_informations.",
     *      tags={"App_screen_information"},
     *      description="Get all App_screen_informations",
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
     *                  @SWG\Items(ref="#/definitions/App_screen_information")
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
        $appScreenInformations = $this->appScreenInformationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(App_screen_informationResource::collection($appScreenInformations), 'App Screen Informations retrieved successfully');
    }
    public function app_screen_language_wise(Request $request)
    {
        $data = \App\Models\App_screen_information::where('app_screen_information.screen_name',$request->screen_name)
                                                ->where('app_screen_information.language_id',$request->language_id)
                                                ->leftjoin('language','app_screen_information.language_id','language.id')
                                                ->select('app_screen_information.*','language.language_name as lg_name')
                                                ->first();
        if($data != ''){
            return response(['status'=>'200','Message'=>'Data Found.','data'=>$data]);
        }else{
            return response(['status'=>'401','Message'=>"Data Not Found."]);
        }   
    }

    /**
     * @param CreateApp_screen_informationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/appScreenInformations",
     *      summary="Store a newly created App_screen_information in storage",
     *      tags={"App_screen_information"},
     *      description="Store App_screen_information",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="App_screen_information that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/App_screen_information")
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
     *                  ref="#/definitions/App_screen_information"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateApp_screen_informationAPIRequest $request)
    {
        $input = $request->all();

        $appScreenInformation = $this->appScreenInformationRepository->create($input);

        return $this->sendResponse(new App_screen_informationResource($appScreenInformation), 'App Screen Information saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/appScreenInformations/{id}",
     *      summary="Display the specified App_screen_information",
     *      tags={"App_screen_information"},
     *      description="Get App_screen_information",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of App_screen_information",
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
     *                  ref="#/definitions/App_screen_information"
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
        /** @var App_screen_information $appScreenInformation */
        $appScreenInformation = $this->appScreenInformationRepository->find($id);

        if (empty($appScreenInformation)) {
            return $this->sendError('App Screen Information not found');
        }

        return $this->sendResponse(new App_screen_informationResource($appScreenInformation), 'App Screen Information retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateApp_screen_informationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/appScreenInformations/{id}",
     *      summary="Update the specified App_screen_information in storage",
     *      tags={"App_screen_information"},
     *      description="Update App_screen_information",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of App_screen_information",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="App_screen_information that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/App_screen_information")
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
     *                  ref="#/definitions/App_screen_information"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateApp_screen_informationAPIRequest $request)
    {
        $input = $request->all();

        /** @var App_screen_information $appScreenInformation */
        $appScreenInformation = $this->appScreenInformationRepository->find($id);

        if (empty($appScreenInformation)) {
            return $this->sendError('App Screen Information not found');
        }

        $appScreenInformation = $this->appScreenInformationRepository->update($input, $id);

        return $this->sendResponse(new App_screen_informationResource($appScreenInformation), 'App_screen_information updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/appScreenInformations/{id}",
     *      summary="Remove the specified App_screen_information from storage",
     *      tags={"App_screen_information"},
     *      description="Delete App_screen_information",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of App_screen_information",
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
        /** @var App_screen_information $appScreenInformation */
        $appScreenInformation = $this->appScreenInformationRepository->find($id);

        if (empty($appScreenInformation)) {
            return $this->sendError('App Screen Information not found');
        }

        $appScreenInformation->delete();

        return $this->sendSuccess('App Screen Information deleted successfully');
    }
}
