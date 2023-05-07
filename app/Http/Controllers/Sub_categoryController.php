<?php

namespace App\Http\Controllers;

use App\DataTables\Sub_categoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSub_categoryRequest;
use App\Http\Requests\UpdateSub_categoryRequest;
use App\Repositories\Sub_categoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Sub_categoryController extends AppBaseController
{
    /** @var  Sub_categoryRepository */
    private $subCategoryRepository;

    public function __construct(Sub_categoryRepository $subCategoryRepo)
    {
        $this->subCategoryRepository = $subCategoryRepo;

        $this->middleware('permission:sub_categories-index|sub_categories-create|sub_categories-edit|sub_categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:sub_categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:sub_categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sub_categories-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Sub_category.
     *
     * @param Sub_categoryDataTable $subCategoryDataTable
     * @return Response
     */
    public function index(Sub_categoryDataTable $subCategoryDataTable)
    {
        $data = \App\Models\Sub_category::orderBy('id','DESC')
                        ->leftjoin('category','sub_category.cat_id','category.id')
                        //->leftjoin('brand','sub_category.business_id','brand.id')
                        ->select('sub_category.*','category.name as cat_name')
                        ->get();
        return view('sub_categories.index',compact('data'));
        //return $subCategoryDataTable->render('sub_categories.index');
    }

    /**
     * Show the form for creating a new Sub_category.
     *
     * @return Response
     */
    public function create()
    {
        $category = \App\Models\Category::where('status',1)->pluck('name','id');
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        return view('sub_categories.create',compact('category','brands'));
    }

    /**
     * Store a newly created Sub_category in storage.
     *
     * @param CreateSub_categoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSub_categoryRequest $request)
    {
        /*$check_position = \App\Models\Sub_category::where('position',$request->position)->first();
        if(empty($check_position)){*/
        $input = $request->all();
        if($request->hasfile('icon'))
        {

            $image = $request->file('icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/icon/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/icon/');
            $image->move($path, $filename);
            $input['icon'] = $filename;
        }else
        {
            $input['icon'] = '';
        }

        $subCategory = $this->subCategoryRepository->create($input);

        Flash::success('Sub Category saved successfully.');

        return redirect(route('subCategories.index'));
       /* }
        else
        {
             Flash::error('Sub Category position already assigned.');

            return redirect(route('subCategories.index'));
        }*/
    }

    /**
     * Display the specified Sub_category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }

        return view('sub_categories.show')->with('subCategory', $subCategory);
    }

    /**
     * Show the form for editing the specified Sub_category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);
        $category = \App\Models\Category::where('status',1)->pluck('name','id');

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }
        /*$brands = \App\Models\Brand::where('sub_id',$id)->where('status','1')->pluck('name','id');*/
        $brands = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.sub_cat_id',$id)
                                                ->leftjoin('brand','bussiness_cat_subcat_mapping.business_id','brand.id')
                                                ->pluck('brand.name','brand.id');

        return view('sub_categories.edit',compact('category','brands'))->with('subCategory', $subCategory);
    }

    /**
     * Update the specified Sub_category in storage.
     *
     * @param  int              $id
     * @param UpdateSub_categoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSub_categoryRequest $request)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }
         $input = $request->all();
        if($request->hasfile('icon'))
        {

            $image = $request->file('icon');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename ='public/media/cat/icon/'.$image->getClientOriginalName();
            $path = public_path('/media/cat/icon/');
            $image->move($path, $filename);
            $input['icon'] = $filename;
        }else
        {
            $input['icon'] = $subCategory['icon'];
        }

        $subCategory = $this->subCategoryRepository->update($input, $id);

        Flash::success('Sub Category updated successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Remove the specified Sub_category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }

        $this->subCategoryRepository->delete($id);

        Flash::success('Sub Category deleted successfully.');

        return redirect(route('subCategories.index'));
    }
    public function sub_categories_status($id, $status)
    {

        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $subCategory = $this->subCategoryRepository->update($data, $id);

        Flash::success('Sub Category status updated successfully.');

        return redirect(route('subCategories.index'));
    }
}
