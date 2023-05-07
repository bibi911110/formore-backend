<?php

namespace App\Http\Controllers;

use App\DataTables\Services_productDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateServices_productRequest;
use App\Http\Requests\UpdateServices_productRequest;
use App\Repositories\Services_productRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Services_productController extends AppBaseController
{
    /** @var  Services_productRepository */
    private $servicesProductRepository;

    public function __construct(Services_productRepository $servicesProductRepo)
    {
        $this->servicesProductRepository = $servicesProductRepo;

        $this->middleware('permission:services_products-index|services_products-create|services_products-edit|services_products-delete', ['only' => ['index','store']]);
        $this->middleware('permission:services_products-create', ['only' => ['create','store']]);
        $this->middleware('permission:services_products-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:services_products-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Services_product.
     *
     * @param Services_productDataTable $servicesProductDataTable
     * @return Response
     */
    public function index(Services_productDataTable $servicesProductDataTable)
    {
        // return $servicesProductDataTable->render('services_products.index');

         $data = \App\Models\Services_product::where('services_product.created_by',Auth::user()->id)
                            ->orderBy('services_product.id','DESC')
                            ->leftjoin('booking_categories','services_product.cat_id','booking_categories.id')
                            ->select('services_product.*','booking_categories.name as catName')->get();
        return view('services_products.index',compact('data'));
    }

    /**
     * Show the form for creating a new Services_product.
     *
     * @return Response
     */
    public function create()
    {
        $category = \App\Models\Booking_categories::where('created_by',Auth::user()->id)->where('status',1)->pluck('name','id');
        return view('services_products.create',compact('category'));
    }

    /**
     * Store a newly created Services_product in storage.
     *
     * @param CreateServices_productRequest $request
     *
     * @return Response
     */
    public function store(CreateServices_productRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;
        $input['status'] = 1;
        if($request->hasfile('product_img'))
        {

            $image = $request->file('product_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/service/product_img/'.$image->getClientOriginalName();
            $path = public_path('/media/service/product_img/');
            $image->move($path, $filename);
            $input['product_img'] = $filename;
        }else
        {
            $input['product_img'] = '';
        }


        $servicesProduct = $this->servicesProductRepository->create($input);

        Flash::success('Services Product saved successfully.');

        return redirect(route('servicesProducts.index'));
    }

    /**
     * Display the specified Services_product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            Flash::error('Services Product not found');

            return redirect(route('servicesProducts.index'));
        }

        return view('services_products.show')->with('servicesProduct', $servicesProduct);
    }

    /**
     * Show the form for editing the specified Services_product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            Flash::error('Services Product not found');

            return redirect(route('servicesProducts.index'));
        }
        $category = \App\Models\Booking_categories::where('created_by',Auth::user()->id)->where('status',1)->pluck('name','id');

        return view('services_products.edit',compact('category'))->with('servicesProduct', $servicesProduct);
    }

    /**
     * Update the specified Services_product in storage.
     *
     * @param  int              $id
     * @param UpdateServices_productRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServices_productRequest $request)
    {
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            Flash::error('Services Product not found');

            return redirect(route('servicesProducts.index'));
        }
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;
        $input['status'] = 1;
        if($request->hasfile('product_img'))
        {

            $image = $request->file('product_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/service/product_img/'.$image->getClientOriginalName();
            $path = public_path('/media/service/product_img/');
            $image->move($path, $filename);
            $input['product_img'] = $filename;
        }else
        {
            $input['product_img'] = $servicesProduct['product_img'];
        }
        $servicesProduct = $this->servicesProductRepository->update($input, $id);

        Flash::success('Services Product updated successfully.');

        return redirect(route('servicesProducts.index'));
    }

    /**
     * Remove the specified Services_product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $servicesProduct = $this->servicesProductRepository->find($id);

        if (empty($servicesProduct)) {
            Flash::error('Services Product not found');

            return redirect(route('servicesProducts.index'));
        }

        $this->servicesProductRepository->delete($id);

        Flash::success('Services Product deleted successfully.');

        return redirect(route('servicesProducts.index'));
    }
}
