<?php

namespace App\Http\Controllers;

use App\DataTables\Coupon_master_orderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCoupon_master_orderRequest;
use App\Http\Requests\UpdateCoupon_master_orderRequest;
use App\Repositories\Coupon_master_orderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Coupon_master_orderController extends AppBaseController
{
    /** @var  Coupon_master_orderRepository */
    private $couponMasterOrderRepository;

    public function __construct(Coupon_master_orderRepository $couponMasterOrderRepo)
    {
        $this->couponMasterOrderRepository = $couponMasterOrderRepo;

        $this->middleware('permission:coupon_master_orders-index|coupon_master_orders-create|coupon_master_orders-edit|coupon_master_orders-delete', ['only' => ['index','store']]);
        $this->middleware('permission:coupon_master_orders-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon_master_orders-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupon_master_orders-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Coupon_master_order.
     *
     * @param Coupon_master_orderDataTable $couponMasterOrderDataTable
     * @return Response
     */
    public function index(Coupon_master_orderDataTable $couponMasterOrderDataTable)
    {
         $data = \App\Models\Coupon_master_order::where('coupon_master_order.created_by',Auth::user()->id)
                            ->orderBy('coupon_master_order.id','DESC')
                            ->get();
                            
        return view('coupon_master_orders.index',compact('data'));
       // return $couponMasterOrderDataTable->render('coupon_master_orders.index');
    }

    /**
     * Show the form for creating a new Coupon_master_order.
     *
     * @return Response
     */
    public function create()
    {
        return view('coupon_master_orders.create');
    }

    /**
     * Store a newly created Coupon_master_order in storage.
     *
     * @param CreateCoupon_master_orderRequest $request
     *
     * @return Response
     */
    public function store(CreateCoupon_master_orderRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;

        $couponMasterOrder = $this->couponMasterOrderRepository->create($input);

        Flash::success('Coupon Master Order saved successfully.');

        return redirect(route('couponMasterOrders.index'));
    }

    /**
     * Display the specified Coupon_master_order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            Flash::error('Coupon Master Order not found');

            return redirect(route('couponMasterOrders.index'));
        }

        return view('coupon_master_orders.show')->with('couponMasterOrder', $couponMasterOrder);
    }

    /**
     * Show the form for editing the specified Coupon_master_order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            Flash::error('Coupon Master Order not found');

            return redirect(route('couponMasterOrders.index'));
        }

        return view('coupon_master_orders.edit')->with('couponMasterOrder', $couponMasterOrder);
    }

    /**
     * Update the specified Coupon_master_order in storage.
     *
     * @param  int              $id
     * @param UpdateCoupon_master_orderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoupon_master_orderRequest $request)
    {
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            Flash::error('Coupon Master Order not found');

            return redirect(route('couponMasterOrders.index'));
        }

        $couponMasterOrder = $this->couponMasterOrderRepository->update($request->all(), $id);

        Flash::success('Coupon Master Order updated successfully.');

        return redirect(route('couponMasterOrders.index'));
    }

    /**
     * Remove the specified Coupon_master_order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $couponMasterOrder = $this->couponMasterOrderRepository->find($id);

        if (empty($couponMasterOrder)) {
            Flash::error('Coupon Master Order not found');

            return redirect(route('couponMasterOrders.index'));
        }

        $this->couponMasterOrderRepository->delete($id);

        Flash::success('Coupon Master Order deleted successfully.');

        return redirect(route('couponMasterOrders.index'));
    }
}
