<?php

namespace App\Http\Controllers;

use App\DataTables\App_screen_informationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateApp_screen_informationRequest;
use App\Http\Requests\UpdateApp_screen_informationRequest;
use App\Repositories\App_screen_informationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class App_screen_informationController extends AppBaseController
{
    /** @var  App_screen_informationRepository */
    private $appScreenInformationRepository;

    public function __construct(App_screen_informationRepository $appScreenInformationRepo)
    {
        $this->appScreenInformationRepository = $appScreenInformationRepo;

        $this->middleware('permission:app_screen_informations-index|app_screen_informations-create|app_screen_informations-edit|app_screen_informations-delete', ['only' => ['index','store']]);
        $this->middleware('permission:app_screen_informations-create', ['only' => ['create','store']]);
        $this->middleware('permission:app_screen_informations-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:app_screen_informations-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the App_screen_information.
     *
     * @param App_screen_informationDataTable $appScreenInformationDataTable
     * @return Response
     */
    public function index(App_screen_informationDataTable $appScreenInformationDataTable)
    {
       // return $appScreenInformationDataTable->render('app_screen_informations.index');
        $data = \App\Models\App_screen_information::orderBy('id','DESC')
                                                ->leftjoin('language','app_screen_information.language_id','language.id')
                                                ->select('app_screen_information.*','language.language_name as lg_name')
                                                ->get();
                                                
        return view('app_screen_informations.index',compact('data'));
    }

    /**
     * Show the form for creating a new App_screen_information.
     *
     * @return Response
     */
    public function create()
    {
        $language = \App\Models\Language::where('status',1)->pluck('language_name','id');
        return view('app_screen_informations.create',compact('language'));
    }

    /**
     * Store a newly created App_screen_information in storage.
     *
     * @param CreateApp_screen_informationRequest $request
     *
     * @return Response
     */
    public function store(CreateApp_screen_informationRequest $request)
    {
        $input = $request->all();

        $appScreenInformation = $this->appScreenInformationRepository->create($input);

        Flash::success('App Screen Information saved successfully.');

        return redirect(route('appScreenInformations.index'));
    }

    /**
     * Display the specified App_screen_information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appScreenInformation = $this->appScreenInformationRepository->find($id);

        if (empty($appScreenInformation)) {
            Flash::error('App Screen Information not found');

            return redirect(route('appScreenInformations.index'));
        }

        return view('app_screen_informations.show')->with('appScreenInformation', $appScreenInformation);
    }

    /**
     * Show the form for editing the specified App_screen_information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appScreenInformation = $this->appScreenInformationRepository->find($id);
        $language = \App\Models\Language::where('status',1)->pluck('language_name','id');
        if (empty($appScreenInformation)) {
            Flash::error('App Screen Information not found');

            return redirect(route('appScreenInformations.index'));
        }

        return view('app_screen_informations.edit',compact('language'))->with('appScreenInformation', $appScreenInformation);
    }

    /**
     * Update the specified App_screen_information in storage.
     *
     * @param  int              $id
     * @param UpdateApp_screen_informationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApp_screen_informationRequest $request)
    {
        $appScreenInformation = $this->appScreenInformationRepository->find($id);

        if (empty($appScreenInformation)) {
            Flash::error('App Screen Information not found');

            return redirect(route('appScreenInformations.index'));
        }

        $appScreenInformation = $this->appScreenInformationRepository->update($request->all(), $id);

        Flash::success('App Screen Information updated successfully.');

        return redirect(route('appScreenInformations.index'));
    }

    /**
     * Remove the specified App_screen_information from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appScreenInformation = $this->appScreenInformationRepository->find($id);

        if (empty($appScreenInformation)) {
            Flash::error('App Screen Information not found');

            return redirect(route('appScreenInformations.index'));
        }

        $this->appScreenInformationRepository->delete($id);

        Flash::success('App Screen Information deleted successfully.');

        return redirect(route('appScreenInformations.index'));
    }
}
