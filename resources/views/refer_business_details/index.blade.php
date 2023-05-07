@extends('layouts.app')
@section('title','Referrals  Details')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Referrals Details</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('referBusinessDetails.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">User Id</th>
                      <th class="text-center">Name of Business</th>
                      <th class="text-center">Business email</th>
                      <th class="text-center">Your Name</th>
                      <th class="text-center">Your Email</th>
                      <th class="text-center">Status</th>
                      
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $business_details)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $business_details->name_of_business }}</td>
                      <td class="text-center">{{ $business_details->owner_email }}</td>
                      <td class="text-center">{{ $business_details->your_name }}</td>
                      <td class="text-center">{{ $business_details->your_email }}</td>
                      <td class="text-center">{{ $business_details->status }}</td>
                      
                      <td class="text-center">
                          {!! Form::open(['route' => ['referBusinessDetails.destroy', $business_details->id], 'method' => 'delete']) !!}
                           <a href="{{ route('referBusinessDetails.edit', $business_details->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                            <div class='btn-group'>
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

