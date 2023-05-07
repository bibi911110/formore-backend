<?php

namespace App\Http\Controllers;

use App\DataTables\Order_productsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrder_productsRequest;
use App\Http\Requests\UpdateOrder_productsRequest;
use App\Repositories\Order_productsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Order_productsController extends AppBaseController
{
    /** @var  Order_productsRepository */
    private $orderProductsRepository;

    public function __construct(Order_productsRepository $orderProductsRepo)
    {
        $this->orderProductsRepository = $orderProductsRepo;

        $this->middleware('permission:order_products-index|order_products-create|order_products-edit|order_products-delete', ['only' => ['index','store']]);
        $this->middleware('permission:order_products-create', ['only' => ['create','store']]);
        $this->middleware('permission:order_products-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order_products-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Order_products.
     *
     * @param Order_productsDataTable $orderProductsDataTable
     * @return Response
     */
    public function index(Order_productsDataTable $orderProductsDataTable)
    {
        $data = \App\Models\Order_products::where('order_products.created_by',Auth::user()->id)
                            ->orderBy('order_products.id','DESC')
                            ->leftjoin('order_categories','order_products.cat_id','order_categories.id')
                            ->select('order_products.*','order_categories.name as catName')->get();
        return view('order_products.index',compact('data'));
        //return $orderProductsDataTable->render('order_products.index');
    }

    /**
     * Show the form for creating a new Order_products.
     *
     * @return Response
     */
    public function create()
    {
        $category = \App\Models\Order_categories::where('created_by',Auth::user()->id)->where('status',1)->pluck('name','id');
        return view('order_products.create',compact('category'));
    }

    /**
     * Store a newly created Order_products in storage.
     *
     * @param CreateOrder_productsRequest $request
     *
     * @return Response
     */
    public function store(CreateOrder_productsRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $input['status'] = 1;
        if($request->hasfile('product_img'))
        {

            $image = $request->file('product_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/product_img/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/product_img/');
            $image->move($path, $filename);
            $input['product_img'] = $filename;
        }else
        {
            $input['product_img'] = '';
        }

        $orderProducts = $this->orderProductsRepository->create($input);

        Flash::success('Order Products saved successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Display the specified Order_products.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }


        return view('order_products.show')->with('orderProducts', $orderProducts);
    }

    /**
     * Show the form for editing the specified Order_products.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }
         $category = \App\Models\Order_categories::where('created_by',Auth::user()->id)->where('status',1)->pluck('name','id');

        return view('order_products.edit',compact('category'))->with('orderProducts', $orderProducts);
    }

    /**
     * Update the specified Order_products in storage.
     *
     * @param  int              $id
     * @param UpdateOrder_productsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrder_productsRequest $request)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }
         $input = $request->all();
        if($request->hasfile('product_img'))
        {

            $image = $request->file('product_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/product_img/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/product_img/');
            $image->move($path, $filename);
            $input['product_img'] = $filename;
        }else
        {
            $input['product_img'] = $orderProducts['product_img'];
        }

        $orderProducts = $this->orderProductsRepository->update($input, $id);

        Flash::success('Order Products updated successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Remove the specified Order_products from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }

        $this->orderProductsRepository->delete($id);

        Flash::success('Order Products deleted successfully.');

        return redirect(route('orderProducts.index'));
    }
}
