<?php

namespace App\Http\Controllers;

use App\DataTables\Order_categoriesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrder_categoriesRequest;
use App\Http\Requests\UpdateOrder_categoriesRequest;
use App\Repositories\Order_categoriesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Order_categoriesController extends AppBaseController
{
    /** @var  Order_categoriesRepository */
    private $orderCategoriesRepository;

    public function __construct(Order_categoriesRepository $orderCategoriesRepo)
    {
        $this->orderCategoriesRepository = $orderCategoriesRepo;

        $this->middleware('permission:order_categories-index|order_categories-create|order_categories-edit|order_categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:order_categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:order_categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:order_categories-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Order_categories.
     *
     * @param Order_categoriesDataTable $orderCategoriesDataTable
     * @return Response
     */
    public function index(Order_categoriesDataTable $orderCategoriesDataTable)
    {
        //return $orderCategoriesDataTable->render('order_categories.index');
        $data = \App\Models\Order_categories::where('created_by',Auth::user()->id)->orderBy('order_categories.id','DESC')->get();
                                                    
      
        return view('order_categories.index',compact('data'));
    }

    /**
     * Show the form for creating a new Order_categories.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_categories.create');
    }

    /**
     * Store a newly created Order_categories in storage.
     *
     * @param CreateOrder_categoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateOrder_categoriesRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $input['status'] = 1;

        $orderCategories = $this->orderCategoriesRepository->create($input);

        Flash::success('Order Categories saved successfully.');

        return redirect(route('orderCategories.index'));
    }

    /**
     * Display the specified Order_categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            Flash::error('Order Categories not found');

            return redirect(route('orderCategories.index'));
        }

        return view('order_categories.show')->with('orderCategories', $orderCategories);
    }

    /**
     * Show the form for editing the specified Order_categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            Flash::error('Order Categories not found');

            return redirect(route('orderCategories.index'));
        }

        return view('order_categories.edit')->with('orderCategories', $orderCategories);
    }

    /**
     * Update the specified Order_categories in storage.
     *
     * @param  int              $id
     * @param UpdateOrder_categoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrder_categoriesRequest $request)
    {
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            Flash::error('Order Categories not found');

            return redirect(route('orderCategories.index'));
        }

        $orderCategories = $this->orderCategoriesRepository->update($request->all(), $id);

        Flash::success('Order Categories updated successfully.');

        return redirect(route('orderCategories.index'));
    }

    /**
     * Remove the specified Order_categories from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderCategories = $this->orderCategoriesRepository->find($id);

        if (empty($orderCategories)) {
            Flash::error('Order Categories not found');

            return redirect(route('orderCategories.index'));
        }

        $this->orderCategoriesRepository->delete($id);

        Flash::success('Order Categories deleted successfully.');

        return redirect(route('orderCategories.index'));
    }

    public function order_categories_status($id, $status)
    {

        $category = $this->orderCategoriesRepository->find($id);

        if (empty($category)) {
            Flash::error('Order Categories not found');

            return redirect(route('orderCategories.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $category = $this->orderCategoriesRepository->update($data, $id);

        Flash::success('Order Categories status updated successfully.');

        return redirect(route('orderCategories.index'));
    }
}
