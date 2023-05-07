<?php

namespace App\Http\Controllers;

use App\DataTables\Tutorial_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTutorial_masterRequest;
use App\Http\Requests\UpdateTutorial_masterRequest;
use App\Repositories\Tutorial_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Tutorial_masterController extends AppBaseController
{
    /** @var  Tutorial_masterRepository */
    private $tutorialMasterRepository;

    public function __construct(Tutorial_masterRepository $tutorialMasterRepo)
    {
        $this->tutorialMasterRepository = $tutorialMasterRepo;

        $this->middleware('permission:tutorial_masters-index|tutorial_masters-create|tutorial_masters-edit|tutorial_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:tutorial_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:tutorial_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tutorial_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Tutorial_master.
     *
     * @param Tutorial_masterDataTable $tutorialMasterDataTable
     * @return Response
     */
    public function index(Tutorial_masterDataTable $tutorialMasterDataTable)
    {
        //return $tutorialMasterDataTable->render('tutorial_masters.index');
        $data = \App\Models\Tutorial_master::orderBy('tutorial_master.id','DESC')
                                            ->leftjoin('language','tutorial_master.language_id','language.id')
                                            ->select('tutorial_master.*','language.language_name as langName')
                                            ->get();


        return view('tutorial_masters.index',compact('data'));

    }

    /**
     * Show the form for creating a new Tutorial_master.
     *
     * @return Response
     */
    public function create()
    {
        $language = \App\Models\Language::where('status','1')->pluck('language_name','id');
        return view('tutorial_masters.create',compact('language'));
    }

    /**
     * Store a newly created Tutorial_master in storage.
     *
     * @param CreateTutorial_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateTutorial_masterRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('tutorial_video'))
        {

            $image = $request->file('tutorial_video');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/tutorial_video/'.$image->getClientOriginalName();
            $path = public_path('/media/tutorial_video/');
            $image->move($path, $filename);
            $input['tutorial_video'] = $filename;
        }else
        {
            $input['tutorial_video'] = '';
        }
        $input['status'] = '1'; 


        $tutorialMaster = $this->tutorialMasterRepository->create($input);

        Flash::success('Tutorial Master saved successfully.');

        return redirect(route('tutorialMasters.index'));
    }

    /**
     * Display the specified Tutorial_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            Flash::error('Tutorial Master not found');

            return redirect(route('tutorialMasters.index'));
        }

        return view('tutorial_masters.show')->with('tutorialMaster', $tutorialMaster);
    }

    /**
     * Show the form for editing the specified Tutorial_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            Flash::error('Tutorial Master not found');

            return redirect(route('tutorialMasters.index'));
        }
        $language = \App\Models\Language::where('status','1')->pluck('language_name','id');

        return view('tutorial_masters.edit',compact('language'))->with('tutorialMaster', $tutorialMaster);
    }

    /**
     * Update the specified Tutorial_master in storage.
     *
     * @param  int              $id
     * @param UpdateTutorial_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTutorial_masterRequest $request)
    {
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            Flash::error('Tutorial Master not found');

            return redirect(route('tutorialMasters.index'));
        }
        $input = $request->all();
        if($request->hasfile('tutorial_video'))
        {

            $image = $request->file('tutorial_video');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/tutorial_video/'.$image->getClientOriginalName();
            $path = public_path('/media/tutorial_video/');
            $image->move($path, $filename);
            $input['tutorial_video'] = $filename;
        }else
        {
            $input['tutorial_video'] = $tutorialMaster['tutorial_video'];
        }


        $tutorialMaster = $this->tutorialMasterRepository->update($input, $id);

        Flash::success('Tutorial Master updated successfully.');

        return redirect(route('tutorialMasters.index'));
    }

    /**
     * Remove the specified Tutorial_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            Flash::error('Tutorial Master not found');

            return redirect(route('tutorialMasters.index'));
        }

        $this->tutorialMasterRepository->delete($id);

        Flash::success('Tutorial Master deleted successfully.');

        return redirect(route('tutorialMasters.index'));
    }
    public function tutorial_status($id, $status)
    {

        $tutorialMaster = $this->tutorialMasterRepository->find($id);

        if (empty($tutorialMaster)) {
            Flash::error('Tutorial not found');

            return redirect(route('tutorialMasters.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $tutorialMaster = $this->tutorialMasterRepository->update($data, $id);

        Flash::success('Tutorial status updated successfully.');

        return redirect(route('tutorialMasters.index'));
    }
}
