<?php

namespace App\Http\Controllers;

use App\DataTables\About_usDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAbout_usRequest;
use App\Http\Requests\UpdateAbout_usRequest;
use App\Repositories\About_usRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class About_usController extends AppBaseController
{
    /** @var  About_usRepository */
    private $aboutUsRepository;

    public function __construct(About_usRepository $aboutUsRepo)
    {
        $this->aboutUsRepository = $aboutUsRepo;

        $this->middleware('permission:about_uses-index|about_uses-create|about_uses-edit|about_uses-delete', ['only' => ['index','store']]);
        $this->middleware('permission:about_uses-create', ['only' => ['create','store']]);
        $this->middleware('permission:about_uses-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:about_uses-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the About_us.
     *
     * @param About_usDataTable $aboutUsDataTable
     * @return Response
     */
    public function index(About_usDataTable $aboutUsDataTable)
    {
         $data = \App\Models\About_us::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('about_uses.index',compact('data'));
       // return $aboutUsDataTable->render('about_uses.index');
    }

    /**
     * Show the form for creating a new About_us.
     *
     * @return Response
     */
    public function create()
    {
        return view('about_uses.create');
    }

    /**
     * Store a newly created About_us in storage.
     *
     * @param CreateAbout_usRequest $request
     *
     * @return Response
     */
    public function store(CreateAbout_usRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $aboutUs = $this->aboutUsRepository->create($input);

        Flash::success('About Us saved successfully.');

        return redirect(route('aboutUses.index'));
    }

    /**
     * Display the specified About_us.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            Flash::error('About Us not found');

            return redirect(route('aboutUses.index'));
        }

        return view('about_uses.show')->with('aboutUs', $aboutUs);
    }

    /**
     * Show the form for editing the specified About_us.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            Flash::error('About Us not found');

            return redirect(route('aboutUses.index'));
        }

        return view('about_uses.edit')->with('aboutUs', $aboutUs);
    }

    /**
     * Update the specified About_us in storage.
     *
     * @param  int              $id
     * @param UpdateAbout_usRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAbout_usRequest $request)
    {
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            Flash::error('About Us not found');

            return redirect(route('aboutUses.index'));
        }

        $aboutUs = $this->aboutUsRepository->update($request->all(), $id);

        Flash::success('About Us updated successfully.');

        return redirect(route('aboutUses.index'));
    }

    /**
     * Remove the specified About_us from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aboutUs = $this->aboutUsRepository->find($id);

        if (empty($aboutUs)) {
            Flash::error('About Us not found');

            return redirect(route('aboutUses.index'));
        }

        $this->aboutUsRepository->delete($id);

        Flash::success('About Us deleted successfully.');

        return redirect(route('aboutUses.index'));
    }
}
