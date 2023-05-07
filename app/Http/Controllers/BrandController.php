<?php

namespace App\Http\Controllers;

use App\DataTables\BrandDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Repositories\BrandRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Validator;
use DB;

class BrandController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;

        $this->middleware('permission:brands-index|brands-create|brands-edit|brands-delete', ['only' => ['index','store']]);
        $this->middleware('permission:brands-create', ['only' => ['create','store']]);
        $this->middleware('permission:brands-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brands-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Brand.
     *
     * @param BrandDataTable $brandDataTable
     * @return Response
     */
    public function index(BrandDataTable $brandDataTable)
    {
         $data = \App\Models\Brand::orderBy('id','DESC')
                        ->leftjoin('category','brand.cat_id','category.id')
                        ->leftjoin('sub_category','brand.sub_id','sub_category.id')
                        ->select('brand.*','category.name as cat_name','sub_category.name as sub_name')
                        ->get();

        return view('brands.index',compact('data'));
        // return $brandDataTable->render('brands.index');
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        $category = \App\Models\Category::where('status',1)->pluck('name','id');
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $currency_data = \DB::table('currency')->pluck('currency_code','id');
        //$sub_category = \App\Models\Sub_category::where('status',1)->pluck('name','id');
        return view('brands.create',compact('category','country_data','currency_data'));
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        
        /*$check_position = \App\Models\Brand::where('position',$request->position)->first();
        if(empty($check_position)){*/
         $request->validate([
                'email' => 'required|unique:users,email',
                'password' => 'required'
                
            ]);

        
        $input = $request->all();
        $subcat_id = $input['sub_id'];
        unset($input['sub_id']);
        unset($input['cat_id']);


        if(isset($request->services))
        {
             $input['services'] = implode(',', $request->services);

        }
        if($request->hasfile('brand_icon'))
        {
            $image = $request->file('brand_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/brand_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/brand_icon/');
            $image->move($path, $filename);
            $input['brand_icon'] = $filename;
        }
        else
        {
            $input['brand_icon'] = '';
        } 
        if($request->hasfile('other_program_icon'))
        {
            $image = $request->file('other_program_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/other_program_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/other_program_icon/');
            $image->move($path, $filename);
            $input['other_program_icon'] = $filename;
        }
        else
        {
            $input['other_program_icon'] = '';
        }



        $brand = $this->brandRepository->create($input);
        
        foreach ($subcat_id as  $value) {
            $data = \App\Models\Sub_category::where('id',$value)->select('id','cat_id')->first();
            $dataArray = array('cat_id' => $data->cat_id,'sub_cat_id' => $data->id,'business_id' => $brand->id);
            $brand_cat = \App\Models\Bussiness_cat_subcat_mapping::create($dataArray);
        }
        

        $user = \App\User::create(['name' => $request['name'],
                                            'email' => $request['email'],
                                            'role_id' => 3,
                                            'user_type' => 3,
                                            'is_admin' => 1,
                                            'userDetailsId'=>$brand->id,
                                            'password' => bcrypt($request->password),
                                            'show_password' => $request->password,
                                            ]);
        $user->assignRole(3);

        Flash::success('Brand saved successfully.');

        return redirect(route('brands.index'));


    }

    /**
     * Display the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }

        return view('brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);
        $category = \App\Models\Category::where('status',1)->select('id','name')->get();
        $country_data = \App\Models\Country::where('status','1')->pluck('country_name','id');
        $currency_data = \DB::table('currency')->pluck('currency_code','id');

        

        $brandCat = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$id)->select('cat_id')->get();
        $selectCat = [];
        foreach ($brandCat as  $value) {
            array_push($selectCat, $value['cat_id']);
            //$selectCat = array("id" => $value['cat_id']);
        }
        

        $brandSubCat = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$id)->select('sub_cat_id')->get();

        $selectSubCat = [];

        foreach ($brandSubCat as  $value) {
            array_push($selectSubCat, $value['sub_cat_id']);
            //$selectCat = array("id" => $value['cat_id']);
        }
        
        //$sub_category = \App\Models\Sub_category::where('cat_id',$brand->cat_id)->where('status',1)->get();

        $sub_category = \App\Models\Sub_category::leftJoin('category','category.id','=','sub_category.cat_id')
        ->whereIn('sub_category.cat_id',$selectCat)
        ->where('sub_category.status', '1')
        ->select(DB::raw("CONCAT(category.name,'-',sub_category.name) AS cat_subcatName"),'sub_category.id')
        ->get();


        if (empty($brand)) {
            Flash::error('Brand not found');
            return redirect(route('brands.index'));
        }

        return view('brands.edit',compact('category','sub_category','selectCat','selectSubCat','country_data','currency_data'))->with('brand', $brand);
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param  int              $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
      
        $brand = $this->brandRepository->find($id);


        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }
        $input = $request->all();
        $subcat_id = $input['sub_id'];
        unset($input['sub_id']);
        unset($input['cat_id']);

        if(isset($request->services))
        {
             $input['services'] = implode(',', $request->services);

        }
        if($request->hasfile('brand_icon'))
        {

            $image = $request->file('brand_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/brand_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/brand_icon/');
            $image->move($path, $filename);
            $input['brand_icon'] = $filename;
        }else
        {
            $input['brand_icon'] = $brand['brand_icon'];
        }
        if($request->hasfile('other_program_icon'))
        {

            $image = $request->file('other_program_icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/other_program_icon/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/other_program_icon/');
            $image->move($path, $filename);
            $input['other_program_icon'] = $filename;
        }else
        {
            $input['other_program_icon'] = $brand['other_program_icon'];
        }
        /*echo "<pre>";
        print_r($input); exit;*/

        $brand = $this->brandRepository->update($input, $id);

        $deleteData = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$id)->delete();
        foreach ($subcat_id as  $value) {
            $data = \App\Models\Sub_category::where('id',$value)->select('id','cat_id')->first();
            $dataArray = array('cat_id' => $data->cat_id,'sub_cat_id' => $data->id,'business_id' => $id);
            $brand_cat = \App\Models\Bussiness_cat_subcat_mapping::create($dataArray);
        }

        Flash::success('Brand updated successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }

        $this->brandRepository->delete($id);

        Flash::success('Brand deleted successfully.');

        return redirect(route('brands.index'));
    }
    public function brands_status($id, $status)
    {

        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error('Brand not found');

            return redirect(route('brands.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $brand = $this->brandRepository->update($data, $id);

        Flash::success('Brand status updated successfully.');

        return redirect(route('brands.index'));
    }
}
