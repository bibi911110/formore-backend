@extends('layouts.app')
@section('title','Marketplace Priorities')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Marketplace Priorities</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('marketplaceLogos.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
<!--                       <th class="text-center">No</th> -->
                      <th class="text-center">Country</th>
                      <th class="text-center">Position</th>
                      <th class="text-center">Business</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Sub Category</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $link)
                    <tr>
                      <!-- <td class="text-center">{{ $i++ }}</td> -->
                      <td class="text-center">{{ $link->country_name }}</td>
                      <td class="text-center">{{ $link->position }}</td>
                      <td class="text-center">{{ $link->brnadName }}</td>
                      <td class="text-center">{{ $link->catName }}</td>
                      <td class="text-center">{{ $link->subcatName }}</td>
                       <td class="text-center">
                          {!! Form::open(['route' => ['marketplaceLogos.destroy', $link->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('marketplaceLogos.edit', $link->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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
    <script>$(function(){ RoleTablesDatatables.init(); });</script>
@endsection

