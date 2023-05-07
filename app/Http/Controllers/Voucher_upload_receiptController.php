<?php

namespace App\Http\Controllers;

use App\DataTables\Voucher_upload_receiptDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVoucher_upload_receiptRequest;
use App\Http\Requests\UpdateVoucher_upload_receiptRequest;
use App\Repositories\Voucher_upload_receiptRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Exports\Upload_receipt_export;
use App\Exports\Export_upload_scenario_1;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class Voucher_upload_receiptController extends AppBaseController
{
    /** @var  Voucher_upload_receiptRepository */
    private $voucherUploadReceiptRepository;

    public function __construct(Voucher_upload_receiptRepository $voucherUploadReceiptRepo)
    {
        $this->voucherUploadReceiptRepository = $voucherUploadReceiptRepo;

        $this->middleware('permission:voucher_upload_receipts-index|voucher_upload_receipts-create|voucher_upload_receipts-edit|voucher_upload_receipts-delete', ['only' => ['index','store']]);
        $this->middleware('permission:voucher_upload_receipts-create', ['only' => ['create','store']]);
        $this->middleware('permission:voucher_upload_receipts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:voucher_upload_receipts-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Voucher_upload_receipt.
     *
     * @param Voucher_upload_receiptDataTable $voucherUploadReceiptDataTable
     * @return Response
     */
    public function index(Voucher_upload_receiptDataTable $voucherUploadReceiptDataTable)
    {
        //return $voucherUploadReceiptDataTable->render('voucher_upload_receipts.index');
        $data = \App\Models\Voucher_upload_receipt::
        leftjoin('brand','voucher_upload_receipt.business_id','brand.id')
        ->leftjoin('users','voucher_upload_receipt.user_id','users.id')
        ->leftjoin('voucher','voucher_upload_receipt.voucher_id','voucher.id')
        ->select('voucher_upload_receipt.*','brand.name as bussName','users.name as uname','voucher.code as voucherCode')
        ->orderBy('id','DESC')->get();
        return view('voucher_upload_receipts.index',compact('data'));
    }

    /**
     * Show the form for creating a new Voucher_upload_receipt.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher_upload_receipts.create');
    }

    /**
     * Store a newly created Voucher_upload_receipt in storage.
     *
     * @param CreateVoucher_upload_receiptRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucher_upload_receiptRequest $request)
    {
        $input = $request->all();

        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->create($input);

        Flash::success('Voucher Upload Receipt saved successfully.');

        return redirect(route('voucherUploadReceipts.index'));
    }

    /**
     * Display the specified Voucher_upload_receipt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        return view('voucher_upload_receipts.show')->with('voucherUploadReceipt', $voucherUploadReceipt);
    }

    /**
     * Show the form for editing the specified Voucher_upload_receipt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        return view('voucher_upload_receipts.edit')->with('voucherUploadReceipt', $voucherUploadReceipt);
    }

    /**
     * Update the specified Voucher_upload_receipt in storage.
     *
     * @param  int              $id
     * @param UpdateVoucher_upload_receiptRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucher_upload_receiptRequest $request)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->update($request->all(), $id);

        Flash::success('Voucher Upload Receipt updated successfully.');

        return redirect(route('voucherUploadReceipts.index'));
    }

    /**
     * Remove the specified Voucher_upload_receipt from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucherUploadReceipt = $this->voucherUploadReceiptRepository->find($id);

        if (empty($voucherUploadReceipt)) {
            Flash::error('Voucher Upload Receipt not found');

            return redirect(route('voucherUploadReceipts.index'));
        }

        $this->voucherUploadReceiptRepository->delete($id);

        Flash::success('Voucher Upload Receipt deleted successfully.');

        return redirect(route('voucherUploadReceipts.index'));
    }

    public function export_upload_receipt()
    {

        $upload_receipt =  \App\Models\Voucher_upload_receipt::leftjoin('brand','voucher_upload_receipt.business_id','brand.id')
                                                            ->leftjoin('users','voucher_upload_receipt.user_id','users.id')
                                                            ->leftjoin('voucher','voucher_upload_receipt.voucher_id','voucher.id')
                                                            ->select('voucher_upload_receipt.*','brand.name as bussName','users.name as uname','voucher.code as voucherCode')
                                                            ->orderBy('id','DESC')->get();

        

        //$folder_path = date('Y-m-d');
            /*if (!File::exists(public_path() . "/excel/order/" . $folder_path)) {
                File::makeDirectory(public_path() . "/excel/order/" . $folder_path, 0777, true);
            }*/
            $uniqid = uniqid();

            Excel::store(new Upload_receipt_export($upload_receipt),  $uniqid.'.xlsx','excel');


            $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
            $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
            $basename = $uniqid.'.xlsx';
            $path = $uniqid.'.xlsx';
            ob_end_clean(); // this
            ob_start(); // and this
            
            return response()->download($file_path_full, $basename, ['Content-Type' => 'application/force-download']);


            //url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx')
            /*return response()->json([
                'url'     => url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx'),
                'message' => 'Excel Downloaded'
            ]);*/

    }

    public function export_upload_scenario_1($id)
    {

        $export_upload_scenario_1 =  \App\Models\Loyalty_code_scenario1::leftjoin('users','loyalty_code_scenario1.user_id','users.id')
                                                        ->where('voucher_id',$id)
                                                        ->select('loyalty_code_scenario1.*','users.name as uname')
                                                        ->get();

        

        //$folder_path = date('Y-m-d');
            /*if (!File::exists(public_path() . "/excel/order/" . $folder_path)) {
                File::makeDirectory(public_path() . "/excel/order/" . $folder_path, 0777, true);
            }*/
            $uniqid = uniqid();

            Excel::store(new Export_upload_scenario_1($export_upload_scenario_1),  $uniqid.'.xlsx','excel');


            $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
            $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
            $basename = $uniqid.'.xlsx';
            $path = $uniqid.'.xlsx';
            ob_end_clean(); // this
            ob_start(); // and this
            
            return response()->download($file_path_full, $basename, ['Content-Type' => 'application/force-download']);


            //url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx')
            /*return response()->json([
                'url'     => url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx'),
                'message' => 'Excel Downloaded'
            ]);*/

    }
    public function export_upload_scenario_2($id)
    {

        $export_upload_scenario_1 =  \App\Models\Lotery_code_details::leftjoin('users','lotery_code_details.user_id','users.id')
                                                        ->where('voucher_id',$id)
                                                        ->select('lotery_code_details.*','users.name as uname')
                                                        ->get();

        

        //$folder_path = date('Y-m-d');
            /*if (!File::exists(public_path() . "/excel/order/" . $folder_path)) {
                File::makeDirectory(public_path() . "/excel/order/" . $folder_path, 0777, true);
            }*/
            $uniqid = uniqid();

            Excel::store(new Export_upload_scenario_1($export_upload_scenario_1),  $uniqid.'.xlsx','excel');


            $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
            $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
            $basename = $uniqid.'.xlsx';
            $path = $uniqid.'.xlsx';
            ob_end_clean(); // this
            ob_start(); // and this
            
            return response()->download($file_path_full, $basename, ['Content-Type' => 'application/force-download']);


            //url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx')
            /*return response()->json([
                'url'     => url('public/excel/' . $folder_path . '/' . $uniqid . '.xlsx'),
                'message' => 'Excel Downloaded'
            ]);*/

    }
}
