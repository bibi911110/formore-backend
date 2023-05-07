@extends('layouts.app')
@section('title','Coupon Master Orders')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Coupon Master Orders</strong> </h2>
          
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('couponMasterServices.create') }}">Add New</a>
          </h1>
       
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Coupon code</th>
                      <th class="text-center">Start date</th>
                      <th class="text-center">End date</th>
                      <th class="text-center">Type</th>
                      <th class="text-center">Value</th>
                      <th class="text-center">Amount discount</th>
                      <th class="text-center">Point discount</th>
                      <th class="text-center">Coupon info</th>
                      
                     
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $rating)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{$rating->coupon_code}}</td>
                      <td class="text-center">{{$rating->start_date}}</td>
                      <td class="text-center">{{$rating->end_date}}</td>
                      <td class="text-center">{{$rating->amount_type}}</td>
                      <td class="text-center">{{$rating->amount}}</td>
                      <td class="text-center">{{$rating->amount_discount}}</td>
                      <td class="text-center">{{$rating->points_discount}}</td>
                      <td class="text-center">{{$rating->coupon_info}}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['couponMasterServices.destroy', $rating->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('couponMasterServices.edit', $rating->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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






