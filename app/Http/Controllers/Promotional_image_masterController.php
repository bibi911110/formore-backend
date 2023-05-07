<?php

namespace App\Http\Controllers;

use App\DataTables\Promotional_image_masterDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePromotional_image_masterRequest;
use App\Http\Requests\UpdatePromotional_image_masterRequest;
use App\Repositories\Promotional_image_masterRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Promotional_image_masterController extends AppBaseController
{
    /** @var  Promotional_image_masterRepository */
    private $promotionalImageMasterRepository;

    public function __construct(Promotional_image_masterRepository $promotionalImageMasterRepo)
    {
        $this->promotionalImageMasterRepository = $promotionalImageMasterRepo;

        $this->middleware('permission:promotional_image_masters-index|promotional_image_masters-create|promotional_image_masters-edit|promotional_image_masters-delete', ['only' => ['index','store']]);
        $this->middleware('permission:promotional_image_masters-create', ['only' => ['create','store']]);
        $this->middleware('permission:promotional_image_masters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:promotional_image_masters-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Promotional_image_master.
     *
     * @param Promotional_image_masterDataTable $promotionalImageMasterDataTable
     * @return Response
     */
    public function index(Promotional_image_masterDataTable $promotionalImageMasterDataTable)
    {
        return $promotionalImageMasterDataTable->render('promotional_image_masters.index');
    }

    /**
     * Show the form for creating a new Promotional_image_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('promotional_image_masters.create');
    }

    /**
     * Store a newly created Promotional_image_master in storage.
     *
     * @param CreatePromotional_image_masterRequest $request
     *
     * @return Response
     */
    public function store(CreatePromotional_image_masterRequest $request)
    {
        $input = $request->all();

        $promotionalImageMaster = $this->promotionalImageMasterRepository->create($input);

        Flash::success('Promotional Image Master saved successfully.');

        return redirect(route('promotionalImageMasters.index'));
    }

    /**
     * Display the specified Promotional_image_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            Flash::error('Promotional Image Master not found');

            return redirect(route('promotionalImageMasters.index'));
        }

        return view('promotional_image_masters.show')->with('promotionalImageMaster', $promotionalImageMaster);
    }

    /**
     * Show the form for editing the specified Promotional_image_master.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            Flash::error('Promotional Image Master not found');

            return redirect(route('promotionalImageMasters.index'));
        }

        return view('promotional_image_masters.edit')->with('promotionalImageMaster', $promotionalImageMaster);
    }

    /**
     * Update the specified Promotional_image_master in storage.
     *
     * @param  int              $id
     * @param UpdatePromotional_image_masterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromotional_image_masterRequest $request)
    {
        /*echo "<pre>";
        print_r($request->all());exit;*/
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            Flash::error('Promotional Image Master not found');

            return redirect(route('promotionalImageMasters.index'));
        }
        $input = $request->all();
        if($request->hasfile('image_1'))
        {

            $image = $request->file('image_1');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/promotional/image_1/'.$image->getClientOriginalName();
            $path = public_path('/media/promotional/image_1/');
            $image->move($path, $filename);
            $input['image_1'] = $filename;
        }
        else if(isset($input['image_1_check']))
        {
            $input['image_1'] = 'null';
        }
        else
        {
            $input['image_1'] = $promotionalImageMaster['image_1'];
        }
        if($request->hasfile('image_2'))
        {

            $image = $request->file('image_2');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/promotional/image_2/'.$image->getClientOriginalName();
            $path = public_path('/media/promotional/image_2/');
            $image->move($path, $filename);
            $input['image_2'] = $filename;
        }
        else if(isset($input['image_2_check']))
        {
            $input['image_2'] = 'null';
        }
        else
        {
            $input['image_2'] = $promotionalImageMaster['image_2'];
        }
        if($request->hasfile('image_3'))
        {

            $image = $request->file('image_3');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/promotional/image_3/'.$image->getClientOriginalName();
            $path = public_path('/media/promotional/image_3/');
            $image->move($path, $filename);
            $input['image_3'] = $filename;
        }
         else if(isset($input['image_3_check']))
        {
            $input['image_3'] = 'null';
        }
        else
        {
            $input['image_3'] = $promotionalImageMaster['image_3'];
        }
        if($request->hasfile('image_4'))
        {

            $image = $request->file('image_4');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/promotional/image_4/'.$image->getClientOriginalName();
            $path = public_path('/media/promotional/image_4/');
            $image->move($path, $filename);
            $input['image_4'] = $filename;
        }
        else if(isset($input['image_4_check']))
        {
            $input['image_4'] = 'null';
        }
        else
        {
            $input['image_4'] = $promotionalImageMaster['image_4'];
        }
        if($request->hasfile('image_5'))
        {

            $image = $request->file('image_5');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/promotional/image_5/'.$image->getClientOriginalName();
            $path = public_path('/media/promotional/image_5/');
            $image->move($path, $filename);
            $input['image_5'] = $filename;
        }
        else if(isset($input['image_5_check']))
        {
            $input['image_5'] = 'null';
        }
        else
        {
            $input['image_5'] = $promotionalImageMaster['image_5'];
        }
        if($request->hasfile('popup_img'))
        {

            $image = $request->file('popup_img');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/promotional/popup_img/'.$image->getClientOriginalName();
            $path = public_path('/media/promotional/popup_img/');
            $image->move($path, $filename);
            $input['popup_img'] = $filename;
        }else
        {
            $input['popup_img'] = $promotionalImageMaster['popup_img'];
        }


        $promotionalImageMaster = $this->promotionalImageMasterRepository->update($input, $id);

        Flash::success('Promotional Image Master updated successfully.');

        return redirect(url('promotionalImageMasters/1/edit'));
    }

    /**
     * Remove the specified Promotional_image_master from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promotionalImageMaster = $this->promotionalImageMasterRepository->find($id);

        if (empty($promotionalImageMaster)) {
            Flash::error('Promotional Image Master not found');

            return redirect(route('promotionalImageMasters.index'));
        }

        $this->promotionalImageMasterRepository->delete($id);

        Flash::success('Promotional Image Master deleted successfully.');

        return redirect(route('promotionalImageMasters.index'));
    }
}
