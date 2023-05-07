@extends('layouts.app')
@section('title','Brand')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Brand</strong> </h2>
           <h1 class="pull-right">
                 
                   <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('brands.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">Code</th>
                      <th class="text-center">Type</th>
                      <!-- <th class="text-center">Position</th> -->
                     <!--  <th class="text-center">Stamp/Point</th> -->
                      <th class="text-center">Name</th>
                      <!-- <th class="text-center">Sub Category</th> -->
                      <th class="text-center">Category</th>
                     <!--  <th class="text-center">Icon</th> -->
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $brands)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                     <td class="text-center"><?php if($brands->type == 1){ echo 'Business';}else{ echo 'Brand';} ?></td>
                     <!--  <td class="text-center">{{ $brands->position }}</td> -->
                      <!-- <td class="text-center"><?php if($brands->stamp_point == 1){ echo 'Stamp';}else{ echo 'Point';} ?></td> -->
                       <td class="text-center">{{ $brands->name }}</td>
                      <td class="text-center">
                        <?php 
                          $categoryData = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$brands->id)->get();
                          if(!empty($categoryData))
                          {
                           
                            foreach ($categoryData as $catData) {
                                $catName = App\Models\Category::where('id',$catData['cat_id'])->first();
                                if(!empty($catName))
                                {
                                  echo $catName->name.",";  
                                }
                            }
                          }
                        ?>
                      </td>
                     
                      <td class="text-center">
                       @if($brands->status == 1)
                            <a href="{{ route('brands_status',['id'=> $brands->id,'status'=> $brands->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('brands_status',['id'=> $brands->id,'status'=> $brands->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['brands.destroy', $brands->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('brands.edit', $brands->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                                
              </tbody>
          </table>
      </div>
  </div>
  <!-- END Datatables Content -->
@endsection
@section('scripts')
    <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
        <script>$(function(){ TablesDatatables.init(); });</script>
@endsection


