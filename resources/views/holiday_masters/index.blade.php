@extends('layouts.app')
@section('title','Holiday Masters')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Holiday Masters</strong> </h2>
          
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('holidayMasters.create') }}">Add New</a>
          </h1>
          
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Holiday date</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $language)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $language->title }}</td>
                      <td class="text-center">{{date('Y-m-d',strtotime($language->holiday_date))}}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['holidayMasters.destroy', $language->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('holidayMasters.edit', $language->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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




