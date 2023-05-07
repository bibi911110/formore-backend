@extends('layouts.app')
@section('title','Order Products')
@section('content')
  <div class="block full">
      <div class="block-title">
          <h2><strong>Order Products</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('orderProducts.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Product name</th>
                      <!-- <th class="text-center">Product image</th> -->
                      <th class="text-center">Description</th>
                      <th class="text-center">Available quantities</th>
                      <th class="text-center">Price per quantity</th>
                      <th class="text-center">Points per quantity</th>
                     
                      <!-- <th class="text-center">Status</th> -->
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1;?>
                  @foreach ($data as $key => $categories)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $categories->catName }}</td>
                      <td class="text-center">{{ $categories->name }}</td>
                      <!--   -->
                      <td class="text-center">{{ $categories->ingredients_name }}</td>
                      <td class="text-center">{{ $categories->available_quantities }}</td>
                      <td class="text-center">{{ $categories->price_per_quantity }}</td>
                      <td class="text-center">{{ $categories->points_per_quantity }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['orderProducts.destroy', $categories->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('orderProducts.edit', $categories->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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




