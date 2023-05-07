<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser_business_detailsRequest;
use App\Http\Requests\UpdateUser_business_detailsRequest;
use App\Repositories\User_business_detailsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;

class User_business_detailsController extends AppBaseController
{
    /** @var  User_business_detailsRepository */
    private $userBusinessDetailsRepository;

    public function __construct(User_business_detailsRepository $userBusinessDetailsRepo)
    {
        $this->userBusinessDetailsRepository = $userBusinessDetailsRepo;
    }

    /**
     * Display a listing of the User_business_details.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /*$userBusinessDetails = $this->userBusinessDetailsRepository->paginate(10);

        return view('user_business_details.index')
            ->with('userBusinessDetails', $userBusinessDetails);*/
       $data = \App\Models\User_business_details::leftjoin('users','user_business_details.user_id','users.id')
                                                ->where('user_business_details.user_id',Auth::user()->id)
                                                ->orderBy('user_business_details.id','DESC')
                                                ->select('user_business_details.*','users.name as buss_name')->get();
        return view('user_business_details.index',compact('data'));
    }

    /**
     * Show the form for creating a new User_business_details.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_business_details.create');
    }

    /**
     * Store a newly created User_business_details in storage.
     *
     * @param CreateUser_business_detailsRequest $request
     *
     * @return Response
     */
    public function store(CreateUser_business_detailsRequest $request)
    {
        $input = $request->all();

        if($request->hasfile('logo'))
        {

            $image = $request->file('logo');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/logo/'.$image->getClientOriginalName();
            $path = public_path('/media/logo/');
            $image->move($path, $filename);
            $input['logo'] = $filename;
        }else
        {
          $input['logo'] = '';
        }

        if($request->hasfile('header_banner'))
        {

            $image = $request->file('header_banner');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/header_banner/'.$image->getClientOriginalName();
            $path = public_path('/media/header_banner/');
            $image->move($path, $filename);
            $input['header_banner'] = $filename;
        }else
        {
          $input['header_banner'] = '';
        }
        if($request->hasfile('e_shop_banner'))
        {

            $image = $request->file('e_shop_banner');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/e_shop_banner/'.$image->getClientOriginalName();
            $path = public_path('/media/e_shop_banner/');
            $image->move($path, $filename);
            $input['e_shop_banner'] = $filename;
        }else
        {
          $input['e_shop_banner'] = '';
        }

        if($request->hasfile('booking_banner'))
        {

            $image = $request->file('booking_banner');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/booking_banner/'.$image->getClientOriginalName();
            $path = public_path('/media/booking_banner/');
            $image->move($path, $filename);
            $input['booking_banner'] = $filename;
        }else
        {
          $input['booking_banner'] = '';
        }


        $input['user_id'] = Auth::user()->id;
        $userBusinessDetails = $this->userBusinessDetailsRepository->create($input);

        Flash::success('User Business Details saved successfully.');

        return redirect(route('userBusinessDetails.index'));
    }

    /**
     * Display the specified User_business_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            Flash::error('User Business Details not found');

            return redirect(route('userBusinessDetails.index'));
        }

        return view('user_business_details.show')->with('userBusinessDetails', $userBusinessDetails);
    }

    /**
     * Show the form for editing the specified User_business_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            Flash::error('User Business Details not found');

            return redirect(route('userBusinessDetails.index'));
        }

        return view('user_business_details.edit')->with('userBusinessDetails', $userBusinessDetails);
    }

    /**
     * Update the specified User_business_details in storage.
     *
     * @param int $id
     * @param UpdateUser_business_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUser_business_detailsRequest $request)
    {
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            Flash::error('User Business Details not found');

            return redirect(route('userBusinessDetails.index'));
        }
        $input = $request->all();

        if($request->hasfile('logo'))
        {

            $image = $request->file('logo');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/logo/'.$image->getClientOriginalName();
            $path = public_path('/media/logo/');
            $image->move($path, $filename);
            $input['logo'] = $filename;
        }else
        {
          $input['logo'] = $userBusinessDetails['logo'];
        }

        if($request->hasfile('header_banner'))
        {

            $image = $request->file('header_banner');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/header_banner/'.$image->getClientOriginalName();
            $path = public_path('/media/header_banner/');
            $image->move($path, $filename);
            $input['header_banner'] = $filename;
        }else
        {
          $input['header_banner'] = $userBusinessDetails['header_banner'];
        }
        if($request->hasfile('e_shop_banner'))
        {

            $image = $request->file('e_shop_banner');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/e_shop_banner/'.$image->getClientOriginalName();
            $path = public_path('/media/e_shop_banner/');
            $image->move($path, $filename);
            $input['e_shop_banner'] = $filename;
        }else
        {
          $input['e_shop_banner'] = $userBusinessDetails['e_shop_banner'];
        }

        if($request->hasfile('booking_banner'))
        {

            $image = $request->file('booking_banner');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/booking_banner/'.$image->getClientOriginalName();
            $path = public_path('/media/booking_banner/');
            $image->move($path, $filename);
            $input['booking_banner'] = $filename;
        }else
        {
          $input['booking_banner'] = $userBusinessDetails['booking_banner'];
        }


        $userBusinessDetails = $this->userBusinessDetailsRepository->update($input, $id);

        Flash::success('User Business Details updated successfully.');

        return redirect(route('userBusinessDetails.index'));
    }

    /**
     * Remove the specified User_business_details from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userBusinessDetails = $this->userBusinessDetailsRepository->find($id);

        if (empty($userBusinessDetails)) {
            Flash::error('User Business Details not found');

            return redirect(route('userBusinessDetails.index'));
        }

        $this->userBusinessDetailsRepository->delete($id);

        Flash::success('User Business Details deleted successfully.');

        return redirect(route('userBusinessDetails.index'));
    }
}
