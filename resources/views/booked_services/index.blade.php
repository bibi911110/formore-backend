@extends('layouts.app')
@section('title','Booked Services')
@section('content')

<div class="block full">
      <div class="block-title">
          <h2><strong>Booked Services</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('bookedServices.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Booking Id</th>
                      <th class="text-center">Member name</th>
                      <th class="text-center">Member id</th>
                      <!-- <th class="text-center">Service name</th> -->
                      <!-- <th class="text-center">Order details</th> -->
                      <!-- <th class="text-center">Delivery address</th>
                      <th class="text-center">Member comments</th> -->
                     <!--  <th class="text-center">Booking date time</th> -->
                      <th class="text-center">Advance payment</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Change Status</th>
                      <th class="text-center">View</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $sub_categories)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $sub_categories->booking_id }}</td>
                      <td class="text-center">{{ $sub_categories->member_name }}</td>
                      <?php $user = \App\User::where('id',$sub_categories->member_id)->first(); ?>
                      <td class="text-center">{{ @$user['unique_no'] }}</td>
                     <!--  <td class="text-center">{{ $sub_categories->service_name }}</td> -->
                      <!-- <td class="text-center">{{ $sub_categories->order_details }}</td> -->
                      <!-- <td class="text-center">{{ $sub_categories->delivery_address }}</td>
                      <td class="text-center">{{ $sub_categories->member_comments }}</td> -->
                      <!-- <td class="text-center">{{ $sub_categories->booking_service_date_time }}</td> -->
                      <td class="text-center">{{ $sub_categories->advance_payment }}</td>
                      <td class="text-center">{{ $sub_categories->status }}</td>
                      <td class="text-center"><a type="button" class="btn btn-primary" href="{{ route('bookedServices.edit', $sub_categories->id) }}" data-toggle="tooltip" title="Change Status">Change Status</a></td>
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$i}}">Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Details</b></h4>
                                </div>
                                 <div class="modal-body">

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Member name - </b>{{ $sub_categories->member_name }}
                                      </div>
                                      <div class="col-md-6">
                                  <?php $user = \App\User::where('id',$sub_categories->member_id)->first(); ?>
                                        <b>Member id - </b>{{ @$user['unique_no'] }}
                                      </div>
                                    </div>
                                  <hr>
                                   <div class="row">
                                      <div class="col-md-6">
                                         <b>Member Email - </b>{{ @$user->email }}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Member Phone No. - </b>{{ @$user->mobile_no }}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Total points - </b>{{ $sub_categories->finalpoints }}
                                      </div>
                                      <div class="col-md-6">
                                        <?php $user_data = \App\User::where('id',$sub_categories->created_by)->first();
                                          $brand = \App\Models\Brand::where('id',$user_data->userDetailsId)->first();
                                          //echo $brand['currency']; exit;
                                          $currency = \DB::table('currency')->where('id',$brand['currency'])->first();
                                         ?>
                                        <b>Value - </b>{{ $sub_categories->finalcash }} {{ $currency->currency_code }}
                                      </div>
                                    </div>
                                  <hr>
                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Comments - </b>{{ $sub_categories->comments }}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Advance payment - </b>{{ $sub_categories->advance_payment }}
                                      </div>
                                    </div>
                                  <hr>

                                  <h4><b>Booking And Extra details</b></h4>
                                  <?php /*$cart_extra_details = \App\Models\Order_cart_extra_details::
                                                leftjoin('extra_services','order_cart_extra_details.extra_id','extra_services.id')
                                               ->leftjoin('booking_add_cart_time_order','extra_services.product_id','booking_add_cart_time_order.product_id')
                                               ->leftjoin('services_product','booking_add_cart_time_order.product_id','services_product.id')
                                               ->where('booking_add_cart_time_order.booking_id',$sub_categories->id)
                                              // ->where('order_cart_extra_details.type','2')
                                               ->select('extra_services.*','order_cart_extra_details.name','services_product.name as product_name','order_cart_extra_details.quantity','booking_add_cart_time_order.date','booking_add_cart_time_order.time')
                                               ->get();*/
                                               //echo "<pre>"; print_r($cart_extra_details); exit;
                                      //echo $sub_categories->id; exit;

                                    $cart_extra_details = \App\Models\Services_product::
                                               leftjoin('booking_add_cart_time_order','services_product.id','booking_add_cart_time_order.product_id')
                                               ->leftjoin('order_cart_extra_details','services_product.id','order_cart_extra_details.product_id')
                                               ->leftjoin('extra_services','order_cart_extra_details.extra_id','extra_services.id')
                                              ->where('booking_add_cart_time_order.booking_id',$sub_categories->id)
                                              //->where('order_cart_extra_details.type','2')
                                              //->groupBy('extra_services.product_id')
                                              ->distinct()
                                               ->select('extra_services.*','order_cart_extra_details.name','services_product.name as product_name','booking_add_cart_time_order.date','booking_add_cart_time_order.time','booking_add_cart_time_order.date')
                                               ->get();
                                    foreach ($cart_extra_details as  $value) { ?>
                                      
                                   <div class="row">
                                      <div class="col-md-6">

                                         <b>Product Name - </b>{{ $value->product_name }}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Date - </b>{{ $value->date }}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <b>Time - </b><?php if(isset($value->name)) { echo $value->name; } else { echo "no"; } ?> - <?php if(isset($value->time)) { echo $value->time; } else { echo "no"; } ?>
                                      </div>
                                      <!-- <div class="col-md-6">
                                        <b>Price - </b>{{ $value->price_per_quantity }}
                                      </div> -->
                                    </div>
                                  <hr>
                                <?php } ?>

                                                                  
                              </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['bookedServices.destroy', $sub_categories->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <!-- <a href="{{ route('memberOrders.edit', $sub_categories->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> -->
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






