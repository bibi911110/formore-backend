<?php

namespace App\Http\Controllers;

use App\DataTables\Booking_categoriesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBooking_categoriesRequest;
use App\Http\Requests\UpdateBooking_categoriesRequest;
use App\Repositories\Booking_categoriesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;

class Booking_categoriesController extends AppBaseController
{
    /** @var  Booking_categoriesRepository */
    private $bookingCategoriesRepository;

    public function __construct(Booking_categoriesRepository $bookingCategoriesRepo)
    {
        $this->bookingCategoriesRepository = $bookingCategoriesRepo;

        $this->middleware('permission:booking_categories-index|booking_categories-create|booking_categories-edit|booking_categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:booking_categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:booking_categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:booking_categories-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Booking_categories.
     *
     * @param Booking_categoriesDataTable $bookingCategoriesDataTable
     * @return Response
     */
    public function index(Booking_categoriesDataTable $bookingCategoriesDataTable)
    {
         $data = \App\Models\Booking_categories::where('created_by',Auth::user()->id)->orderBy('booking_categories.id','DESC')->get();
                                                    
      
        return view('booking_categories.index',compact('data'));
       // return $bookingCategoriesDataTable->render('booking_categories.index');
    }

    /**
     * Show the form for creating a new Booking_categories.
     *
     * @return Response
     */
    public function create()
    {
        return view('booking_categories.create');
    }

    /**
     * Store a newly created Booking_categories in storage.
     *
     * @param CreateBooking_categoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateBooking_categoriesRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $input['status'] = 1;


        $bookingCategories = $this->bookingCategoriesRepository->create($input);

        Flash::success('Booking Categories saved successfully.');

        return redirect(route('bookingCategories.index'));
    }

    /**
     * Display the specified Booking_categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            Flash::error('Booking Categories not found');

            return redirect(route('bookingCategories.index'));
        }

        return view('booking_categories.show')->with('bookingCategories', $bookingCategories);
    }

    /**
     * Show the form for editing the specified Booking_categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            Flash::error('Booking Categories not found');

            return redirect(route('bookingCategories.index'));
        }

        return view('booking_categories.edit')->with('bookingCategories', $bookingCategories);
    }

    /**
     * Update the specified Booking_categories in storage.
     *
     * @param  int              $id
     * @param UpdateBooking_categoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBooking_categoriesRequest $request)
    {
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            Flash::error('Booking Categories not found');

            return redirect(route('bookingCategories.index'));
        }

        $bookingCategories = $this->bookingCategoriesRepository->update($request->all(), $id);

        Flash::success('Booking Categories updated successfully.');

        return redirect(route('bookingCategories.index'));
    }

    /**
     * Remove the specified Booking_categories from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bookingCategories = $this->bookingCategoriesRepository->find($id);

        if (empty($bookingCategories)) {
            Flash::error('Booking Categories not found');

            return redirect(route('bookingCategories.index'));
        }

        $this->bookingCategoriesRepository->delete($id);

        Flash::success('Booking Categories deleted successfully.');

        return redirect(route('bookingCategories.index'));
    }
     public function booking_categories_status($id, $status)
    {

        $category = $this->bookingCategoriesRepository->find($id);

        if (empty($category)) {
            Flash::error('Booking Categories not found');

            return redirect(route('bookingCategories.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $category = $this->bookingCategoriesRepository->update($data, $id);

        Flash::success('Booking Categories status updated successfully.');

        return redirect(route('bookingCategories.index'));
    }
}
