<?php

namespace App\Http\Controllers;

use App\DataTables\SegmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSegmentRequest;
use App\Http\Requests\UpdateSegmentRequest;
use App\Repositories\SegmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SegmentController extends AppBaseController
{
    /** @var  SegmentRepository */
    private $segmentRepository;

    public function __construct(SegmentRepository $segmentRepo)
    {
        $this->segmentRepository = $segmentRepo;

        $this->middleware('permission:segments-index|segments-create|segments-edit|segments-delete', ['only' => ['index','store']]);
        $this->middleware('permission:segments-create', ['only' => ['create','store']]);
        $this->middleware('permission:segments-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:segments-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Segment.
     *
     * @param SegmentDataTable $segmentDataTable
     * @return Response
     */
    public function index(SegmentDataTable $segmentDataTable)
    {
        
        $data = \App\Models\Segment::orderBy('id','DESC')->get();
        return view('segments.index',compact('data'));
    }

    /**
     * Show the form for creating a new Segment.
     *
     * @return Response
     */
    public function create()
    {
        return view('segments.create');
    }

    /**
     * Store a newly created Segment in storage.
     *
     * @param CreateSegmentRequest $request
     *
     * @return Response
     */
    public function store(CreateSegmentRequest $request)
    {
        $input = $request->all();
         $input['status'] = '1';
        $segment = $this->segmentRepository->create($input);

        Flash::success('Segment saved successfully.');

        return redirect(route('segments.index'));
    }

    /**
     * Display the specified Segment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            Flash::error('Segment not found');

            return redirect(route('segments.index'));
        }

        return view('segments.show')->with('segment', $segment);
    }

    /**
     * Show the form for editing the specified Segment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            Flash::error('Segment not found');

            return redirect(route('segments.index'));
        }

        return view('segments.edit')->with('segment', $segment);
    }

    /**
     * Update the specified Segment in storage.
     *
     * @param  int              $id
     * @param UpdateSegmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSegmentRequest $request)
    {
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            Flash::error('Segment not found');

            return redirect(route('segments.index'));
        }

        $segment = $this->segmentRepository->update($request->all(), $id);

        Flash::success('Segment updated successfully.');

        return redirect(route('segments.index'));
    }

    /**
     * Remove the specified Segment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            Flash::error('Segment not found');

            return redirect(route('segments.index'));
        }

        $this->segmentRepository->delete($id);

        Flash::success('Segment deleted successfully.');

        return redirect(route('segments.index'));
    }
    public function segment_status($id,$status)
    {
        $segment = $this->segmentRepository->find($id);

        if (empty($segment)) {
            Flash::error('Segment not found');

            return redirect(route('segments.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $segment = $this->segmentRepository->update($data, $id);

        Flash::success('Segment status updated successfully.');

        return redirect(route('segments.index'));        
    }
}
