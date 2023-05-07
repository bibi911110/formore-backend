@extends('layouts.app')
@section('title','Order Details')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Update </strong> Order</h2>
                </div>
                    {!! Form::open(['url' => 'update_order_status']) !!}

                        

                                <!-- Member Name Field -->
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$order->id}}">
                                    {!! Form::label('code_order', 'Code Order:') !!}
                                    {!! Form::text('code_order', $order->order_id, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Member Id Field -->
                                <div class="form-group">
                                    {!! Form::label('name', 'Surname / Name:') !!}
                                    {!! Form::text('member_name', $order->member_name, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Order Details Field -->
                                <!-- <div class="form-group">
                                    {!! Form::label('member_id', 'member ID:') !!}
                                    {!! Form::text('member_id', $order->member_id, ['class' => 'form-control']) !!}
                                </div> -->

                                <!-- Delivery Address Field -->
                                <div class="form-group">
                                    {!! Form::label('order_details', 'Order Details:') !!}
                                   <!--  <?php $order_extra = \App\Models\Order_products_details::where('order_id',$order->id)->select('product_name_extra')->get();
                                    $extra = [];
                                    foreach ($order_extra as $value) {
                                        //$extra.push()
                                        if($value->product_name_extra != '')
                                        {
                                            array_push($extra, $value->product_name_extra);
                                        }
                                    }
                                    
                                    
                                    $extra_string =implode( ",", $extra);
                                     ?>
                                    {!! Form::text('order_details', $extra_string, ['class' => 'form-control']) !!} -->


                        <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$order->id}}">Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$order->id}}" class="modal fade" role="dialog">
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
                                         <b>Member name - </b>{{ $order->member_name }}
                                      </div>
                                      <div class="col-md-6">
                                        <?php $user = \App\User::where('id',$order->member_id)->first();

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
                                        <b>Order Id - </b>{{ $order->order_id }}
                                      </div>
                                      <!-- <div class="col-md-6">
                                         <b>Order details - </b>{{ $order->order_details }}   
                                      </div> -->
                                    </div>
                                  <hr>
                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Order Comments - </b>{{ $order->member_comments }}
                                      </div>
                                      <div class="col-md-6">
                                        <?php if(isset($order->storepick) && $order->storepick == 'true'){ ?>

                                        <b>Address details and Comments - </b> Store Pickup
                                       <?php } else { ?>
                                         <b>Address details and Comments - </b>{{ $order->delivery_address }} - {{ $order->order_details }} 
                                      <?php } ?>
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Points - </b>{{ $order->finalpoints }}
                                      </div>
                                      <div class="col-md-6">
                                        <?php $user_data = \App\User::where('id',$order->created_by)->first();
                                          $brand = \App\Models\Brand::where('id',$user_data->userDetailsId)->first();
                                          //echo $brand['currency']; exit;
                                          $currency = \DB::table('currency')->where('id',$brand['currency'])->first();
                                         ?>
                                        
                                        <b>Cash - </b>{{ $order->finalcash }} {{ $currency->currency_code }}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      
                                      <div class="col-md-6">
                                        <b>Advance payment - </b>{{ $order->advance_payment }}
                                      </div>
                                    </div>
                                  <hr>
                                  <h4><b>Order And Extra details</b></h4>
                                  <?php $cart_extra_details =  \App\Models\Order_products_details::leftjoin('order_products','order_products_details.product_id','order_products.id')
                                                ->where('order_products_details.order_id',$order->id)
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
                                </div>

                                <!-- Member Comments Field -->
                                @if($order->storepick == 'true')
                                 <div class="form-group  Member Orders">
                                    {!! Form::label('address', 'Address Details & Comments:') !!}
                                    <h5>Store Pickup </h5>
                                  </div>
                                @else
                                <div class="form-group  Member Orders">
                                    {!! Form::label('address', 'Address Details & Comments:') !!}
                                    <textarea class="form-control" name="delivery_address">{{$order->delivery_address}}</textarea>
                                    
                                </div>
                                @endif

                                <div class="form-group  Member Orders">
                                    {!! Form::label('member_comments', 'Member Comments:') !!}
                                    <textarea class="form-control" name="member_comments">{{$order->member_comments}}</textarea>
                                    
                                </div>

                                <!-- Advance Payment Field -->
                                <div class="form-group  Member Orders">
                                    {!! Form::label('payment', 'Payment Method:') !!}
                                    {!! Form::text('advance_payment', $order->advance_payment, ['class' => 'form-control']) !!}
                                </div>

                                <!-- Points Field -->
                                

                                <!-- Cash Field -->
                                

                                <!-- Status Field -->
                                <div class="form-group  Member Orders">
                                    {!! Form::label('status', 'Select Status:') !!}
                                    {!! Form::select('status', [''=>'Select Status','Open' => 'Open',"Preparing order" => 'Preparing order',"For delivery" => 'For delivery',"Delivered" => 'Delivered',"Cancel" =>'Cancel'], $order->status, ['class' => 'form-control','id' => 'campaign_type']) !!}
                                </div>
                                

                                <!-- Submit Field -->
                                <div class="form-group">
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                    
                                </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
