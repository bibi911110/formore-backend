<?php

namespace App\Http\Controllers;

use App\DataTables\CountryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;

        $this->middleware('permission:countries-index|countries-create|countries-edit|countries-delete', ['only' => ['index','store']]);
        $this->middleware('permission:countries-create', ['only' => ['create','store']]);
        $this->middleware('permission:countries-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:countries-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Country.
     *
     * @param CountryDataTable $countryDataTable
     * @return Response
     */
    public function index(CountryDataTable $countryDataTable)
    {
        $data = \App\Models\Country::orderBy('id','DESC')->get();
        return view('countries.index',compact('data'));
       // return $countryDataTable->render('countries.index');
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {

        return view('countries.create');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();
        if($request->hasfile('country_icon'))
        {

            $image = $request->file('country_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/country_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/country_icon/');
            $image->move($path, $filename);
            $input['country_icon'] = $filename;
        }else
        {
          $input['country_icon'] = '';
        }
        $input['status'] = '1';
        $country = $this->countryRepository->create($input);

        Flash::success('Country saved successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }
        $brands = \App\Models\Brand::where('status','1')->where('country_id',$id)->pluck('name','id');
        return view('countries.edit',compact('brands'))->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param  int              $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        /*echo "<pre>";
        print_r($request->all()); exit;*/
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }
        $input = $request->all();
        if($request->hasfile('country_icon'))
        {

            $image = $request->file('country_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/country_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/country_icon/');
            $image->move($path, $filename);
            $input['country_icon'] = $filename;
        }else
        {
          $input['country_icon'] =  $country['country_icon'];
        }
        $country = $this->countryRepository->update($input, $id);

        $data = Date('Y-m-d : h:s:i');
        $question_details = \App\Models\Country_business_position::where('country_id', $id)->update(['deleted_at' => $data]);
         for ($i=0; $i<count($request->business_id); $i++) {
                if($request->business_id[$i] != '')
                {
                    $segments_data = new \App\Models\Country_business_position;
                    $segments_data->country_id = $id;
                    $segments_data->business_id = $request->business_id[$i];
                    $segments_data->position = $request->position[$i];
                    $segments_data->save();
                }
                
            }

        Flash::success('Country updated successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $this->countryRepository->delete($id);

        Flash::success('Country deleted successfully.');

        return redirect(route('countries.index'));
    }
    public function country_status($id,$status)
    {
        
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }
        if($status == 1)
        {
            $data['status'] = 0;
        }
        else
        {
            $data['status'] = 1;
        }
        $country = $this->countryRepository->update($data, $id);

        Flash::success('Country Status updated successfully.');

        return redirect(route('countries.index'));
    }
}
