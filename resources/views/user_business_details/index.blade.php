@extends('layouts.app')
@section('title','Business Details')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Business Details</strong> </h2>
           <h1 class="pull-right">
    <?php  $count_data = \App\Models\User_business_details::where('user_id',Auth::user()->id)->count();  if($count_data != 1){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('userBusinessDetails.create') }}">Add New</a>
  <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Logo</th>
                      <th class="text-center">Header banner</th>
                      <th class="text-center">Business name</th>
                      <th class="text-center">Map Link</th>
                      <!-- <th class="text-center">Total available points</th> -->
                      <th class="text-center">E_shop banner</th>
                      <th class="text-center">booking banner</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $u_details)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center"><img src="<?php echo  url('/').'/'.$u_details->logo; ?>" style="width: 25%"  ></td>
                      <td class="text-center"><img src="<?php echo  url('/').'/'.$u_details->header_banner; ?>" style="width: 25%"  ></td>
                      <td class="text-center">{{ $u_details->buss_name }}</td>
                      <td class="text-center">{{ $u_details->map_link }}</td>
                      <!-- <td class="text-center">{{ $u_details->user_available_points }}</td> -->
                      <td class="text-center"><img src="<?php echo  url('/').'/'.$u_details->e_shop_banner; ?>" style="width: 25%"  ></td>
                      <td class="text-center"><img src="<?php echo  url('/').'/'.$u_details->booking_banner; ?>" style="width: 25%"  ></td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['userBusinessDetails.destroy', $u_details->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('userBusinessDetails.edit', $u_details->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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
        <script>$(function(){ TablesDatatables.init(); });</script>
@endsection



