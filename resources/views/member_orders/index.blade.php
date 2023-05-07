@extends('layouts.app')
@section('title','Member Orders')
@section('content')

<div class="block full">
      <div class="block-title">
          <h2><strong>Member Orders</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('memberOrders.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Order Id</th>
                      <th class="text-center">Member name</th>
                      <th class="text-center">Member id</th>
                      <th class="text-center">Date</th>
                      <!-- <th class="text-center">Order details</th> -->
                      <!-- <th class="text-center">Delivery address</th>
                      <th class="text-center">Member comments</th> -->
                      <th class="text-center">Advance payment</th>
                      <th class="text-center">Points</th>
                      <th class="text-center">Cash</th>
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
                      <td class="text-center">{{ $sub_categories->order_id }}</td>
                      <td class="text-center">{{ $sub_categories->member_name }}</td>
                      <?php $user = \App\User::where('id',$sub_categories->member_id)->first(); ?>
                      <td class="text-center">{{ @$user['unique_no'] }}</td>
                      <td class="text-center">{{date('Y-m-d',strtotime($sub_categories['created_at']))}}</td>
                      <!-- <td class="text-center">{{ $sub_categories->order_details }}</td> -->
                      <!-- <td class="text-center">{{ $sub_categories->delivery_address }}</td>
                      <td class="text-center">{{ $sub_categories->member_comments }}</td> -->
                      <td class="text-center">{{ $sub_categories->advance_payment }}</td>
                      <td class="text-center">{{ $sub_categories->finalpoints }}</td>
                      <td class="text-center">{{ $sub_categories->finalcash }}</td>
                      <td class="text-center">{{ $sub_categories->status }}</td>
                      <td class="text-center"><a type="button" class="btn btn-primary" href="{{ route('memberOrders.edit', $sub_categories->id) }}" data-toggle="tooltip" title="Change Status">Change Status</a></td>
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
                                  <?php $user = \App\User::where('id',$sub_categories->member_id)->first();

                                     ?>
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
                                        <b>Order Id - </b>{{ $sub_categories->order_id }}
                                      </div>
                                      <!-- <div class="col-md-6">
                                         <b>Order details - </b>{{ $sub_categories->order_details }}   
                                      </div> -->
                                    </div>
                                  <hr>
                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Order Comments - </b>{{ $sub_categories->member_comments }}
                                      </div>
                                      <div class="col-md-6">
                                        <?php if(isset($sub_categories->storepick) && $sub_categories->storepick == 'true'){ ?>

                                        <b>Address details and Comments - </b> Store Pickup
                                       <?php } else { ?>
                                         <b>Address details and Comments - </b>{{ $sub_categories->delivery_address }} - {{ $sub_categories->order_details }} 
                                      <?php } ?>
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Points - </b>{{ $sub_categories->finalpoints }}
                                      </div>
                                      <div class="col-md-6">
                                        <?php $user_data = \App\User::where('id',$sub_categories->created_by)->first();
                                          $brand = \App\Models\Brand::where('id',$user_data->userDetailsId)->first();
                                          //echo $brand['currency']; exit;
                                          $currency = \DB::table('currency')->where('id',$brand['currency'])->first();
                                         ?>
                                        
                                        <b>Cash - </b>{{ $sub_categories->finalcash }} {{ $currency->currency_code }}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      
                                      <div class="col-md-6">
                                        <b>Advance payment - </b>{{ $sub_categories->advance_payment }}
                                      </div>
                                    </div>
                                  <hr>
                                  <h4><b>Order And Extra details</b></h4>
                                  <?php $cart_extra_details =  \App\Models\Order_products_details::leftjoin('order_products','order_products_details.product_id','order_products.id')
                                                ->where('order_products_details.order_id',$sub_categories->id)
                                               ->where('order_products_details.type','1')
                                              // ->groupBy('order_product_extra_details.id')
                                               ->select('order_products_details.*','order_products.name as product_name')
                                               ->get();
                                      //echo $sub_categories->id; exit;
                                    foreach ($cart_extra_details as  $value) { ?>
                                      
                                   <div class="row">
                                      <div class="col-md-6">
                                         <b>Product Name - </b>{{ $value->product_name }}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Quantity - </b><?php if(isset($value->product_name_extra)) { echo $value->product_name_extra; } else { echo "no"; } ?> 
                                      </div>
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
                          {!! Form::open(['route' => ['memberOrders.destroy', $sub_categories->id], 'method' => 'delete']) !!}
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




