<?php

namespace App\Http\Controllers;

use App\DataTables\LanguageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Repositories\LanguageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LanguageController extends AppBaseController
{
    /** @var  LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;

        $this->middleware('permission:languages-index|languages-create|languages-edit|languages-delete', ['only' => ['index','store']]);
        $this->middleware('permission:languages-create', ['only' => ['create','store']]);
        $this->middleware('permission:languages-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:languages-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Language.
     *
     * @param LanguageDataTable $languageDataTable
     * @return Response
     */
    public function index(LanguageDataTable $languageDataTable)
    {
        $data = \App\Models\Language::orderBy('id','DESC')->get();
        return view('languages.index',compact('data'));
        
    }

    /**
     * Show the form for creating a new Language.
     *
     * @return Response
     */
    public function create()
    {
        return view('languages.create');
    }

    /**
     * Store a newly created Language in storage.
     *
     * @param CreateLanguageRequest $request
     *
     * @return Response
     */
    public function store(CreateLanguageRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('icon_img'))
        {

            $image = $request->file('icon_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/icon_img/'.$image->getClientOriginalName();
            $path = public_path('/media/icon_img/');
            $image->move($path, $filename);
            $input['icon_img'] = $filename;
        }else
        {
            $input['icon_img'] = '';
        }
        $input['status'] = '1'; 
        $language = $this->languageRepository->create($input);

        Flash::success('Language saved successfully.');

        return redirect(route('languages.index'));
    }

    /**
     * Display the specified Language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        return view('languages.show')->with('language', $language);
    }

    /**
     * Show the form for editing the specified Language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        return view('languages.edit')->with('language', $language);
    }

    /**
     * Update the specified Language in storage.
     *
     * @param  int              $id
     * @param UpdateLanguageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLanguageRequest $request)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }
        
        $input = $request->all();
        if($request->hasfile('icon_img'))
        {

            $image = $request->file('icon_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/icon_img/'.$image->getClientOriginalName();
            $path = public_path('/media/icon_img/');
            $image->move($path, $filename);
            $input['icon_img'] = $filename;
        }else
        {
            $input['icon_img'] = $language['icon_img'];
        }

        $language = $this->languageRepository->update($input, $id);

        Flash::success('Language updated successfully.');

        return redirect(route('languages.index'));
    }

    /**
     * Remove the specified Language from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        $this->languageRepository->delete($id);

        Flash::success('Language deleted successfully.');

        return redirect(route('languages.index'));
    }
    public function language_status($id, $status)
    {

        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $language = $this->languageRepository->update($data, $id);

        Flash::success('Language status updated successfully.');

        return redirect(route('languages.index'));
    }
}
