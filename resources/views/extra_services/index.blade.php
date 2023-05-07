@extends('layouts.app')
@section('title','Extra Services')
@section('content')
  <div class="block full">
      <div class="block-title">
          <h2><strong>Extra Services</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('extraServices.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Service/Product</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Price per slot</th>
                      <th class="text-center">Point per slot</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1;?>
                  @foreach ($data as $key => $categories)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $categories->prodcutName }}</td>
                      <td class="text-center">{{ $categories->services_name }}</td>
                      <td class="text-center">{{ $categories->services_per_price }}</td>
                      <td class="text-center">{{ $categories->services_per_point }}</td>
                       <td class="text-center">
                       @if($categories->status == 1)
                            <a href="{{ route('service_extra_status',['id'=> $categories->id,'status'=> $categories->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('service_extra_status',['id'=> $categories->id,'status'=> $categories->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                           <td class="text-center">
                          {!! Form::open(['route' => ['extraServices.destroy', $categories->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('extraServices.edit', $categories->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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








