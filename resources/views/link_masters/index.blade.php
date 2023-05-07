@extends('layouts.app')
@section('title','Link Master')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Link</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('languages.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Terms & Condition</th>
                      <th class="text-center">Privacy Policy</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $link)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $link->term_link }}</td>
                      <td class="text-center">{{ $link->privacy_link }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['linkMasters.destroy', $link->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('linkMasters.edit', $link->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                               <!--  {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!} -->
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
