<?php

namespace App\Http\Controllers;

use App\DataTables\Purchase_optionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePurchase_optionsRequest;
use App\Http\Requests\UpdatePurchase_optionsRequest;
use App\Repositories\Purchase_optionsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Purchase_optionsController extends AppBaseController
{
    /** @var  Purchase_optionsRepository */
    private $purchaseOptionsRepository;

    public function __construct(Purchase_optionsRepository $purchaseOptionsRepo)
    {
        $this->purchaseOptionsRepository = $purchaseOptionsRepo;

        $this->middleware('permission:purchase_options-index|purchase_options-create|purchase_options-edit|purchase_options-delete', ['only' => ['index','store']]);
        $this->middleware('permission:purchase_options-create', ['only' => ['create','store']]);
        $this->middleware('permission:purchase_options-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:purchase_options-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Purchase_options.
     *
     * @param Purchase_optionsDataTable $purchaseOptionsDataTable
     * @return Response
     */
    public function index(Purchase_optionsDataTable $purchaseOptionsDataTable)
    {
         $data = \App\Models\Purchase_options::where('code_status',NULL)->where('v_code','!=','')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('purchase_options.index',compact('data'));
        //return $purchaseOptionsDataTable->render('purchase_options.index');
    }

    /**
     * Show the form for creating a new Purchase_options.
     *
     * @return Response
     */
    public function create()
    {
        $today = date('Y-m-d');
        $voucher = \App\Models\Voucher::where('category_id','2')
                    ->where('code_status','!=','1')
                    ->whereDate('start_date','<=', $today)
                    ->whereDate('end_date','>=', $today)
                    ->pluck('code','code');
        return view('purchase_options.create',compact('voucher'));
    }

    /**
     * Store a newly created Purchase_options in storage.
     *
     * @param CreatePurchase_optionsRequest $request
     *
     * @return Response
     */
    public function store(CreatePurchase_optionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['v_code'] = implode(',', $input['v_code']);

        $purchaseOptions = $this->purchaseOptionsRepository->create($input);

        Flash::success('Purchase Options saved successfully.');

        return redirect(route('purchaseOptions.index'));
    }

    /**
     * Display the specified Purchase_options.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            Flash::error('Purchase Options not found');

            return redirect(route('purchaseOptions.index'));
        }

        return view('purchase_options.show')->with('purchaseOptions', $purchaseOptions);
    }

    /**
     * Show the form for editing the specified Purchase_options.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            Flash::error('Purchase Options not found');

            return redirect(route('purchaseOptions.index'));
        }
         $today = date('Y-m-d');
         $voucher = \App\Models\Voucher::where('category_id','2')
                    ->where('code_status','!=','1')
                    ->whereDate('start_date','<=', $today)
                    ->whereDate('end_date','>=', $today)
                    ->get();
                    
        return view('purchase_options.edit',compact('voucher'))->with('purchaseOptions', $purchaseOptions);
    }

    /**
     * Update the specified Purchase_options in storage.
     *
     * @param  int              $id
     * @param UpdatePurchase_optionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePurchase_optionsRequest $request)
    {
        $input = $request->all();
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            Flash::error('Purchase Options not found');

            return redirect(route('purchaseOptions.index'));
        }
        $input['v_code'] = implode(',', $input['v_code']);
        $purchaseOptions = $this->purchaseOptionsRepository->update($input, $id);

        Flash::success('Purchase Options updated successfully.');

        return redirect(route('purchaseOptions.index'));
    }

    /**
     * Remove the specified Purchase_options from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            Flash::error('Purchase Options not found');

            return redirect(route('purchaseOptions.index'));
        }

        $this->purchaseOptionsRepository->delete($id);

        Flash::success('Purchase Options deleted successfully.');

        return redirect(route('purchaseOptions.index'));
    }
    public function purchase_status($id, $status)
    {

         $purchaseOptions = $this->purchaseOptionsRepository->find($id);

        if (empty($purchaseOptions)) {
            Flash::error('Purchase Options not found');

            return redirect(route('purchaseOptions.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $purchaseOptions = $this->purchaseOptionsRepository->update($data, $id);

        Flash::success('Purchase Options status updated successfully.');

        return redirect(route('purchaseOptions.index'));
    }
}
