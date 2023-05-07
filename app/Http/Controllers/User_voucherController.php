<?php

namespace App\Http\Controllers;

use App\DataTables\User_voucherDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUser_voucherRequest;
use App\Http\Requests\UpdateUser_voucherRequest;
use App\Repositories\User_voucherRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class User_voucherController extends AppBaseController
{
    /** @var  User_voucherRepository */
    private $userVoucherRepository;

    public function __construct(User_voucherRepository $userVoucherRepo)
    {
        $this->userVoucherRepository = $userVoucherRepo;

        $this->middleware('permission:user_vouchers-index|user_vouchers-create|user_vouchers-edit|user_vouchers-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user_vouchers-create', ['only' => ['create','store']]);
        $this->middleware('permission:user_vouchers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user_vouchers-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the User_voucher.
     *
     * @param User_voucherDataTable $userVoucherDataTable
     * @return Response
     */
    public function index(User_voucherDataTable $userVoucherDataTable)
    {
        return $userVoucherDataTable->render('user_vouchers.index');
    }

    /**
     * Show the form for creating a new User_voucher.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_vouchers.create');
    }

    /**
     * Store a newly created User_voucher in storage.
     *
     * @param CreateUser_voucherRequest $request
     *
     * @return Response
     */
    public function store(CreateUser_voucherRequest $request)
    {
        $input = $request->all();

        $userVoucher = $this->userVoucherRepository->create($input);

        Flash::success('User Voucher saved successfully.');

        return redirect(route('userVouchers.index'));
    }

    /**
     * Display the specified User_voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            Flash::error('User Voucher not found');

            return redirect(route('userVouchers.index'));
        }

        return view('user_vouchers.show')->with('userVoucher', $userVoucher);
    }

    /**
     * Show the form for editing the specified User_voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            Flash::error('User Voucher not found');

            return redirect(route('userVouchers.index'));
        }

        return view('user_vouchers.edit')->with('userVoucher', $userVoucher);
    }

    /**
     * Update the specified User_voucher in storage.
     *
     * @param  int              $id
     * @param UpdateUser_voucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUser_voucherRequest $request)
    {
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            Flash::error('User Voucher not found');

            return redirect(route('userVouchers.index'));
        }

        $userVoucher = $this->userVoucherRepository->update($request->all(), $id);

        Flash::success('User Voucher updated successfully.');

        return redirect(route('userVouchers.index'));
    }

    /**
     * Remove the specified User_voucher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userVoucher = $this->userVoucherRepository->find($id);

        if (empty($userVoucher)) {
            Flash::error('User Voucher not found');

            return redirect(route('userVouchers.index'));
        }

        $this->userVoucherRepository->delete($id);

        Flash::success('User Voucher deleted successfully.');

        return redirect(route('userVouchers.index'));
    }
}
