<?php

namespace App\Http\Controllers;

use App\DataTables\Order_product_extra_detailsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrder_product_extra_detailsRequest;
use App\Http\Requests\UpdateOrder_product_extra_detailsRequest;
use App\Repositories\Order_product_extra_detailsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Order_product_extra_detailsController extends AppBaseController
{
    /** @var  Order_product_extra_detailsRepository */
    private $orderProductExtraDetailsRepository;

    public function __construct(Order_product_extra_detailsRepository $orderProductExtraDetailsRepo)
    {
        $this->orderProductExtraDetailsRepository = $orderProductExtraDetailsRepo;

        $this->middleware('permission:order_product_extra_details-index|order_product_extra_details-create|order_product_extra_details-edit|order_product_extra_details-delete', ['only' => ['index','store']]);
        $this->middleware('permission:order_product_extra_details-create', ['only' => ['create','store']]);
        $this->middleware('permission:order_product_extra_details-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order_product_extra_details-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Order_product_extra_details.
     *
     * @param Order_product_extra_detailsDataTable $orderProductExtraDetailsDataTable
     * @return Response
     */
    public function index(Order_product_extra_detailsDataTable $orderProductExtraDetailsDataTable)
    {
         $data = \App\Models\Order_product_extra_details::where('order_product_extra_details.created_by',Auth::user()->id)
                            ->orderBy('order_product_extra_details.id','DESC')
                            ->leftjoin('order_products','order_product_extra_details.product_id','order_products.id')
                            ->select('order_product_extra_details.*','order_products.name as prodcutName')->get();
                            
        return view('order_product_extra_details.index',compact('data'));
        //return $orderProductExtraDetailsDataTable->render('order_product_extra_details.index');
    }

    /**
     * Show the form for creating a new Order_product_extra_details.
     *
     * @return Response
     */
    public function create()
    {
        $product = \App\Models\Order_products::where('created_by',Auth::user()->id)->pluck('name','id');
        return view('order_product_extra_details.create',compact('product'));
    }

    /**
     * Store a newly created Order_product_extra_details in storage.
     *
     * @param CreateOrder_product_extra_detailsRequest $request
     *
     * @return Response
     */
    public function store(CreateOrder_product_extra_detailsRequest $request)
    {
        $input = $request->all();
        $input['status'] = 1;
        $input['created_by'] = Auth::user()->id;
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->create($input);

        Flash::success('Order Product Extra Details saved successfully.');

        return redirect(route('orderProductExtraDetails.index'));
    }

    /**
     * Display the specified Order_product_extra_details.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            Flash::error('Order Product Extra Details not found');

            return redirect(route('orderProductExtraDetails.index'));
        }

        return view('order_product_extra_details.show')->with('orderProductExtraDetails', $orderProductExtraDetails);
    }

    /**
     * Show the form for editing the specified Order_product_extra_details.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            Flash::error('Order Product Extra Details not found');

            return redirect(route('orderProductExtraDetails.index'));
        }
        $product = \App\Models\Order_products::where('created_by',Auth::user()->id)->pluck('name','id');

        return view('order_product_extra_details.edit',compact('product'))->with('orderProductExtraDetails', $orderProductExtraDetails);
    }

    /**
     * Update the specified Order_product_extra_details in storage.
     *
     * @param  int              $id
     * @param UpdateOrder_product_extra_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrder_product_extra_detailsRequest $request)
    {
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            Flash::error('Order Product Extra Details not found');

            return redirect(route('orderProductExtraDetails.index'));
        }

        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->update($request->all(), $id);

        Flash::success('Order Product Extra Details updated successfully.');

        return redirect(route('orderProductExtraDetails.index'));
    }

    /**
     * Remove the specified Order_product_extra_details from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderProductExtraDetails = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($orderProductExtraDetails)) {
            Flash::error('Order Product Extra Details not found');

            return redirect(route('orderProductExtraDetails.index'));
        }

        $this->orderProductExtraDetailsRepository->delete($id);

        Flash::success('Order Product Extra Details deleted successfully.');

        return redirect(route('orderProductExtraDetails.index'));
    }

    public function product_extra_status($id, $status)
    {

        $category = $this->orderProductExtraDetailsRepository->find($id);

        if (empty($category)) {
            Flash::error('Order Product Extra Details not found');

            return redirect(route('orderProductExtraDetails.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $category = $this->orderProductExtraDetailsRepository->update($data, $id);

        Flash::success('Order Product Extra Details status updated successfully.');

        return redirect(route('orderProductExtraDetails.index'));
    }
}
