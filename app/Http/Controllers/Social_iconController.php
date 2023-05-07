<?php

namespace App\Http\Controllers;

use App\DataTables\Social_iconDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSocial_iconRequest;
use App\Http\Requests\UpdateSocial_iconRequest;
use App\Repositories\Social_iconRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Social_iconController extends AppBaseController
{
    /** @var  Social_iconRepository */
    private $socialIconRepository;

    public function __construct(Social_iconRepository $socialIconRepo)
    {
        $this->socialIconRepository = $socialIconRepo;

        $this->middleware('permission:social_icons-index|social_icons-create|social_icons-edit|social_icons-delete', ['only' => ['index','store']]);
        $this->middleware('permission:social_icons-create', ['only' => ['create','store']]);
        $this->middleware('permission:social_icons-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:social_icons-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Social_icon.
     *
     * @param Social_iconDataTable $socialIconDataTable
     * @return Response
     */
    public function index(Social_iconDataTable $socialIconDataTable)
    {
        $data = \App\Models\Social_icon::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('social_icons.index',compact('data'));
        //return $socialIconDataTable->render('social_icons.index');
    }

    /**
     * Show the form for creating a new Social_icon.
     *
     * @return Response
     */
    public function create()
    {
        return view('social_icons.create');
    }

    /**
     * Store a newly created Social_icon in storage.
     *
     * @param CreateSocial_iconRequest $request
     *
     * @return Response
     */
    public function store(CreateSocial_iconRequest $request)
    {
        $input = $request->all();

        if($request->hasfile('social_icon'))
        {

            $image = $request->file('social_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/social_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/social_icon/');
            $image->move($path, $filename);
            $input['social_icon'] = $filename;
        }else
        {
          $input['social_icon'] = '';
        }
        $input['user_id'] = Auth::user()->id;
        $socialIcon = $this->socialIconRepository->create($input);

        Flash::success('Social Icon saved successfully.');

        return redirect(route('socialIcons.index'));
    }

    /**
     * Display the specified Social_icon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            Flash::error('Social Icon not found');

            return redirect(route('socialIcons.index'));
        }

        return view('social_icons.show')->with('socialIcon', $socialIcon);
    }

    /**
     * Show the form for editing the specified Social_icon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            Flash::error('Social Icon not found');

            return redirect(route('socialIcons.index'));
        }

        return view('social_icons.edit')->with('socialIcon', $socialIcon);
    }

    /**
     * Update the specified Social_icon in storage.
     *
     * @param  int              $id
     * @param UpdateSocial_iconRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocial_iconRequest $request)
    {
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            Flash::error('Social Icon not found');

            return redirect(route('socialIcons.index'));
        }
        $input = $request->all();

        if($request->hasfile('social_icon'))
        {

            $image = $request->file('social_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/social_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/social_icon/');
            $image->move($path, $filename);
            $input['social_icon'] = $filename;
        }else
        {
          $input['social_icon'] = $socialIcon['social_icon'];
        }

        $socialIcon = $this->socialIconRepository->update($input, $id);

        Flash::success('Social Icon updated successfully.');

        return redirect(route('socialIcons.index'));
    }

    /**
     * Remove the specified Social_icon from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $socialIcon = $this->socialIconRepository->find($id);

        if (empty($socialIcon)) {
            Flash::error('Social Icon not found');

            return redirect(route('socialIcons.index'));
        }

        $this->socialIconRepository->delete($id);

        Flash::success('Social Icon deleted successfully.');

        return redirect(route('socialIcons.index'));
    }
}
