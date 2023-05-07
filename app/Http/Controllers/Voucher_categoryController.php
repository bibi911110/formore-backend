<?php

namespace App\Http\Controllers;

use App\DataTables\Voucher_categoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVoucher_categoryRequest;
use App\Http\Requests\UpdateVoucher_categoryRequest;
use App\Repositories\Voucher_categoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Voucher_categoryController extends AppBaseController
{
    /** @var  Voucher_categoryRepository */
    private $voucherCategoryRepository;

    public function __construct(Voucher_categoryRepository $voucherCategoryRepo)
    {
        $this->voucherCategoryRepository = $voucherCategoryRepo;

        $this->middleware('permission:voucher_categories-index|voucher_categories-create|voucher_categories-edit|voucher_categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:voucher_categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:voucher_categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:voucher_categories-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Voucher_category.
     *
     * @param Voucher_categoryDataTable $voucherCategoryDataTable
     * @return Response
     */
    public function index(Voucher_categoryDataTable $voucherCategoryDataTable)
    {
        return $voucherCategoryDataTable->render('voucher_categories.index');
    }

    /**
     * Show the form for creating a new Voucher_category.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher_categories.create');
    }

    /**
     * Store a newly created Voucher_category in storage.
     *
     * @param CreateVoucher_categoryRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucher_categoryRequest $request)
    {
        $input = $request->all();

        $voucherCategory = $this->voucherCategoryRepository->create($input);

        Flash::success('Voucher Category saved successfully.');

        return redirect(route('voucherCategories.index'));
    }

    /**
     * Display the specified Voucher_category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            Flash::error('Voucher Category not found');

            return redirect(route('voucherCategories.index'));
        }

        return view('voucher_categories.show')->with('voucherCategory', $voucherCategory);
    }

    /**
     * Show the form for editing the specified Voucher_category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            Flash::error('Voucher Category not found');

            return redirect(route('voucherCategories.index'));
        }

        return view('voucher_categories.edit')->with('voucherCategory', $voucherCategory);
    }

    /**
     * Update the specified Voucher_category in storage.
     *
     * @param  int              $id
     * @param UpdateVoucher_categoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucher_categoryRequest $request)
    {
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            Flash::error('Voucher Category not found');

            return redirect(route('voucherCategories.index'));
        }

        $voucherCategory = $this->voucherCategoryRepository->update($request->all(), $id);

        Flash::success('Voucher Category updated successfully.');

        return redirect(route('voucherCategories.index'));
    }

    /**
     * Remove the specified Voucher_category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucherCategory = $this->voucherCategoryRepository->find($id);

        if (empty($voucherCategory)) {
            Flash::error('Voucher Category not found');

            return redirect(route('voucherCategories.index'));
        }

        $this->voucherCategoryRepository->delete($id);

        Flash::success('Voucher Category deleted successfully.');

        return redirect(route('voucherCategories.index'));
    }
}
