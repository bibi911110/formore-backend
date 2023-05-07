<?php

namespace App\Http\Controllers;

use App\DataTables\Social_media_mgtDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSocial_media_mgtRequest;
use App\Http\Requests\UpdateSocial_media_mgtRequest;
use App\Repositories\Social_media_mgtRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Social_media_mgtController extends AppBaseController
{
    /** @var  Social_media_mgtRepository */
    private $socialMediaMgtRepository;

    public function __construct(Social_media_mgtRepository $socialMediaMgtRepo)
    {
        $this->socialMediaMgtRepository = $socialMediaMgtRepo;

        $this->middleware('permission:social_media_mgts-index|social_media_mgts-create|social_media_mgts-edit|social_media_mgts-delete', ['only' => ['index','store']]);
        $this->middleware('permission:social_media_mgts-create', ['only' => ['create','store']]);
        $this->middleware('permission:social_media_mgts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:social_media_mgts-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Social_media_mgt.
     *
     * @param Social_media_mgtDataTable $socialMediaMgtDataTable
     * @return Response
     */
    public function index(Social_media_mgtDataTable $socialMediaMgtDataTable)
    {
        return $socialMediaMgtDataTable->render('social_media_mgts.index');
    }

    /**
     * Show the form for creating a new Social_media_mgt.
     *
     * @return Response
     */
    public function create()
    {
        return view('social_media_mgts.create');
    }

    /**
     * Store a newly created Social_media_mgt in storage.
     *
     * @param CreateSocial_media_mgtRequest $request
     *
     * @return Response
     */
    public function store(CreateSocial_media_mgtRequest $request)
    {
        $input = $request->all();

        $socialMediaMgt = $this->socialMediaMgtRepository->create($input);

        Flash::success('Social Media Mgt saved successfully.');

        return redirect(route('socialMediaMgts.index'));
    }

    /**
     * Display the specified Social_media_mgt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            Flash::error('Social Media Mgt not found');

            return redirect(route('socialMediaMgts.index'));
        }

        return view('social_media_mgts.show')->with('socialMediaMgt', $socialMediaMgt);
    }

    /**
     * Show the form for editing the specified Social_media_mgt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            Flash::error('Social Media Mgt not found');

            return redirect(route('socialMediaMgts.index'));
        }

        return view('social_media_mgts.edit')->with('socialMediaMgt', $socialMediaMgt);
    }

    /**
     * Update the specified Social_media_mgt in storage.
     *
     * @param  int              $id
     * @param UpdateSocial_media_mgtRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocial_media_mgtRequest $request)
    {
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            Flash::error('Social Media Mgt not found');

            return redirect(route('socialMediaMgts.index'));
        }

        $socialMediaMgt = $this->socialMediaMgtRepository->update($request->all(), $id);

        Flash::success('Social Media Mgt updated successfully.');

        return redirect(route('socialMediaMgts.index'));
    }

    /**
     * Remove the specified Social_media_mgt from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $socialMediaMgt = $this->socialMediaMgtRepository->find($id);

        if (empty($socialMediaMgt)) {
            Flash::error('Social Media Mgt not found');

            return redirect(route('socialMediaMgts.index'));
        }

        $this->socialMediaMgtRepository->delete($id);

        Flash::success('Social Media Mgt deleted successfully.');

        return redirect(route('socialMediaMgts.index'));
    }
}
