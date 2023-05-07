<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CategoryController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;

        $this->middleware('permission:categories-index|categories-create|categories-edit|categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        $data = \App\Models\Category::orderBy('category.id','DESC')->get();
                                    //->leftjoin('brand','category.business_id','brand.id')
                                    //->select('category.*','brand.name as brnadName')
                                    
      
        return view('categories.index',compact('data'));
       // return $categoryDataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $brands = \App\Models\Brand::where('status','1')->pluck('name','id');
        return view('categories.create',compact('brands'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {

       // $check_position = \App\Models\Category::where('position',$request->position)->first();
        //if(empty($check_position)){
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
            $input['status'] = '1'; 

            $category = $this->categoryRepository->create($input);

            Flash::success('Category saved successfully.');

            return redirect(route('categories.index'));
       /* }else
        {
             Flash::error('Category position already assigned.');

            return redirect(route('categories.index'));
        }*/
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        //$brands = \App\Models\Brand::where('cat_id',$id)->where('status','1')->pluck('name','id');
        $brands = \App\Models\Bussiness_cat_subcat_mapping::where('bussiness_cat_subcat_mapping.cat_id',$id)
                                                ->leftjoin('brand','bussiness_cat_subcat_mapping.business_id','brand.id')
                                                ->pluck('brand.name','brand.id');
        /*echo "<pre>";
        print_r($brands); exit;*/


        return view('categories.edit',compact('brands'))->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
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
            $input['icon'] = $category['icon'];
        }

        $category = $this->categoryRepository->update($input, $id);

        Flash::success('Category updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }

     public function categories_status($id, $status)
    {

        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $category = $this->categoryRepository->update($data, $id);

        Flash::success('Category status updated successfully.');

        return redirect(route('categories.index'));
    }
}
