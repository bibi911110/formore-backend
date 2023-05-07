<?php

namespace App\Http\Controllers;

use App\DataTables\Loyalty_banner_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLoyalty_banner_masterRequest;
use App\Http\Requests\UpdateLoyalty_banner_masterRequest;
use App\Repositories\Loyalty_banner_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;


class Loyalty_banner_masterController extends AppBaseController
{
    /** @var  Loyalty_banner_masterRepository */
    private $loyaltyBannerMasterRepository;

    public function __construct(Loyalty_banner_masterRepository $loyaltyBannerMasterRepo)
    {
        $this->loyaltyBannerMasterRepository = $loyaltyBannerMasterRepo;

        $this->middleware('permission:loyalty_banner_masters-index|loyalty_banner_masters-create|loyalty_banner_masters-edit|loyalty_banner_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:loyalty_banner_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:loyalty_banner_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:loyalty_banner_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Loyalty_banner_master.
     *
     * @param Loyalty_banner_masterDataTable $loyaltyBannerMasterDataTable
     * @return Response
     */
    public function index(Loyalty_banner_masterDataTable $loyaltyBannerMasterDataTable)
    {
       // return $loyaltyBannerMasterDataTable->render('loyalty_banner_masters.index');

        $data = \App\Models\Loyalty_banner_master::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('loyalty_banner_masters.index',compact('data'));
    }

    /**
     * Show the form for creating a new Loyalty_banner_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('loyalty_banner_masters.create');
    }

    /**
     * Store a newly created Loyalty_banner_master in storage.
     *
     * @param CreateLoyalty_banner_masterRequest $request
     *
     * @return Response
     */
    public function store(CreateLoyalty_banner_masterRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('banner_img'))
        {

            $image = $request->file('banner_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/loyalty/banner_img/'.$image->getClientOriginalName();
            $path = public_path('/media/loyalty/banner_img/');
            $image->move($path, $filename);
            $input['banner_img'] = $filename;
        }else
        {
            $input['banner_img'] = '';
        }
        $input['user_id'] = Auth::user()->id;

        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->create($input);

        Flash::success('Loyalty Banner Master saved successfully.');

        return redirect(route('loyaltyBannerMasters.index'));
    }

    /**
     * Display the specified Loyalty_banner_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            Flash::error('Loyalty Banner Master not found');

            return redirect(route('loyaltyBannerMasters.index'));
        }

        return view('loyalty_banner_masters.show')->with('loyaltyBannerMaster', $loyaltyBannerMaster);
    }

    /**
     * Show the form for editing the specified Loyalty_banner_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            Flash::error('Loyalty Banner Master not found');

            return redirect(route('loyaltyBannerMasters.index'));
        }

        return view('loyalty_banner_masters.edit')->with('loyaltyBannerMaster', $loyaltyBannerMaster);
    }

    /**
     * Update the specified Loyalty_banner_master in storage.
     *
     * @param  int              $id
     * @param UpdateLoyalty_banner_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLoyalty_banner_masterRequest $request)
    {
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            Flash::error('Loyalty Banner Master not found');

            return redirect(route('loyaltyBannerMasters.index'));
        }
        $input = $request->all();
        if($request->hasfile('banner_img'))
        {

            $image = $request->file('banner_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/loyalty/banner_img/'.$image->getClientOriginalName();
            $path = public_path('/media/loyalty/banner_img/');
            $image->move($path, $filename);
            $input['banner_img'] = $filename;
        }else
        {
            $input['banner_img'] = $loyaltyBannerMaster['banner_img'];
        }
        $input['user_id'] = Auth::user()->id;

        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->update($input, $id);

        Flash::success('Loyalty Banner Master updated successfully.');

        return redirect(route('loyaltyBannerMasters.index'));
    }

    /**
     * Remove the specified Loyalty_banner_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loyaltyBannerMaster = $this->loyaltyBannerMasterRepository->find($id);

        if (empty($loyaltyBannerMaster)) {
            Flash::error('Loyalty Banner Master not found');

            return redirect(route('loyaltyBannerMasters.index'));
        }

        $this->loyaltyBannerMasterRepository->delete($id);

        Flash::success('Loyalty Banner Master deleted successfully.');

        return redirect(route('loyaltyBannerMasters.index'));
    }
}
