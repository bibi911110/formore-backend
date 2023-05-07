<?php

namespace App\Http\Controllers;

use App\DataTables\Flag_selectionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFlag_selectionRequest;
use App\Http\Requests\UpdateFlag_selectionRequest;
use App\Repositories\Flag_selectionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Exports\SectionExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Models\Flag_selection;


class Flag_selectionController extends AppBaseController
{
    /** @var  Flag_selectionRepository */
    private $flagSelectionRepository;

    public function __construct(Flag_selectionRepository $flagSelectionRepo)
    {
        $this->flagSelectionRepository = $flagSelectionRepo;

        $this->middleware('permission:flag_selections-index|flag_selections-create|flag_selections-edit|flag_selections-delete', ['only' => ['index','store']]);
        $this->middleware('permission:flag_selections-create', ['only' => ['create','store']]);
        $this->middleware('permission:flag_selections-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:flag_selections-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Flag_selection.
     *
     * @param Flag_selectionDataTable $flagSelectionDataTable
     * @return Response
     */
    public function index(Flag_selectionDataTable $flagSelectionDataTable)
    {
        // return $flagSelectionDataTable->render('flag_selections.index');
        $data = \App\Models\Flag_selection::orderBy('id','DESC')
                        ->leftjoin('brand','flag_selection.buss_id','brand.id')
                        ->leftjoin('users','flag_selection.user_id','users.id')
                        ->leftjoin('segment','flag_selection.segment_id','segment.id')
                        ->select('flag_selection.*','brand.name','users.name as users_name','segment.segment_name')
                        //->groupBy('flag_selection.buss_id')
                        ->get();
        return view('flag_selections.index',compact('data'));
    }

    /**
     * Show the form for creating a new Flag_selection.
     *
     * @return Response
     */
    public function create()
    {
       
        $buss = \App\Models\Brand::where('stamp_point','2')->where('status','1')->pluck('name','id');
        $users = \App\User::where('role_id',4)->pluck('name','id');
        return view('flag_selections.create',compact('buss','users'));
    }

    /**
     * Store a newly created Flag_selection in storage.
     *
     * @param CreateFlag_selectionRequest $request
     *
     * @return Response
     */
    public function store(CreateFlag_selectionRequest $request)
    {
        $input = $request->all();


        for ($i=0; $i<count($request->user_id); $i++) {
                $segments_data = new \App\Models\Flag_selection;
                $segments_data->buss_id = $request->buss_id;
                $segments_data->segment_id = $request->segment_id;
                $segments_data->user_id = $request->user_id[$i];    
                $segments_data->save();
            
        }

       // $flagSelection = $this->flagSelectionRepository->create($input);

        Flash::success('Flag Selection saved successfully.');

        return redirect(route('flagSelections.index'));
    }

    /**
     * Display the specified Flag_selection.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            Flash::error('Flag Selection not found');

            return redirect(route('flagSelections.index'));
        }

        return view('flag_selections.show')->with('flagSelection', $flagSelection);
    }

    /**
     * Show the form for editing the specified Flag_selection.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            Flash::error('Flag Selection not found');

            return redirect(route('flagSelections.index'));
        }
       $buss = \App\Models\Brand::where('stamp_point','2')->where('status','1')->pluck('name','id');
        $users = \App\User::where('role_id',4)->pluck('name','id');
        $segments_data = \App\Models\Segment::where('status',1)->pluck('segment_name','id');

        return view('flag_selections.edit',compact('buss','users','segments_data'))->with('flagSelection', $flagSelection);
    }

    /**
     * Update the specified Flag_selection in storage.
     *
     * @param  int              $id
     * @param UpdateFlag_selectionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlag_selectionRequest $request)
    {
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            Flash::error('Flag Selection not found');

            return redirect(route('flagSelections.index'));
        }

        $flagSelection = $this->flagSelectionRepository->update($request->all(), $id);

        Flash::success('Flag Selection updated successfully.');

        return redirect(route('flagSelections.index'));
    }

    /**
     * Remove the specified Flag_selection from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flagSelection = $this->flagSelectionRepository->find($id);

        if (empty($flagSelection)) {
            Flash::error('Flag Selection not found');

            return redirect(route('flagSelections.index'));
        }

        $this->flagSelectionRepository->delete($id);

        Flash::success('Flag Selection deleted successfully.');

        return redirect(route('flagSelections.index'));
    }
    public function downloadSecion()
    {
        $data = \App\Models\Flag_selection::orderBy('id','DESC')
                        ->leftjoin('brand','flag_selection.buss_id','brand.id')
                        ->leftjoin('users','flag_selection.user_id','users.id')
                        ->leftjoin('segment','flag_selection.segment_id','segment.id')
                        ->select('flag_selection.*','brand.name as brandName','users.name as users_name','segment.segment_name')
                        //->groupBy('flag_selection.buss_id')
                        ->get();
        /*echo "<pre>";
        print_r($data);
        exit;*/

        $folder_path = '/segment_excel/';
        if (!File::exists(public_path()  . $folder_path)) {
            File::makeDirectory(public_path() .  $folder_path, 0777, true);
        }
        $uniqid = uniqid();
        Excel::store(new SectionExport($data), $folder_path . '/' . $uniqid . '.xlsx', 'excel');

        $file_path_full =base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx';
        $file_path =pathinfo(base_path().'/public/excel' . $folder_path . '/' . $uniqid . '.xlsx');
        $basename = $uniqid.'.xlsx';
        $path = $uniqid.'.xlsx';
        ob_end_clean(); // this
        ob_start();

        // Flash::success('Excel is created..please click to download excel.., <a href="'. url('user_export_download' . '/' . $uniqid . '.xlsx') . '"> Download Excel  </a> ');

          Flash::success('Excel is created..please click to download excel.., <a href="'. url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx') . '" target="_blank"> Download Excel  </a> ');

           $data = \App\Models\Flag_selection::orderBy('id','DESC')
                        ->leftjoin('brand','flag_selection.buss_id','brand.id')
                        ->leftjoin('users','flag_selection.user_id','users.id')
                        ->leftjoin('segment','flag_selection.segment_id','segment.id')
                        ->select('flag_selection.*','brand.name','users.name as users_name','segment.segment_name')
                        //->groupBy('flag_selection.buss_id')
                        ->get();
        return view('flag_selections.index',compact('data'));
    }
}
