@extends('layouts.app')
@section('title','Find A Member')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Business </strong> Offers </h2>
                </div>                
                    {!! Form::open(['route' => 'post_give_voucher', 'files' => true]) !!}
                        <!-- Language Name Field -->
                        <div class="row">
                         <div class="col-lg-12">
                            @foreach($offers as $offer)
                                     <div class="form-group col-md-3">
                                    <img src="<?php echo  url('/').'/'. $offer['offer_image']; ?>" data-toggle="modal" data-target="#myLotery_{{$offer->id}}" style="width: 35%">
                                    </div>
                    

                          <!-- Modal -->
                          <div id="myLotery_{{$offer->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Business Offers</b></h4>
                                </div>
                                 <div class="modal-body">
                                     
                                <center>  
                                 <img src="<?php echo  url('/').'/'. $offer['offer_image']; ?>" data-toggle="modal" data-target="#myLotery_{{$offer->id}}" style="width: 50%">
                                 </center>
                                </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                     
                            @endforeach
                         </div>
                        </div>
                    <!-- Submit Field -->
                        <!-- <div class="form-group" style="margin-left: 15px;">
                            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                            
                        </div> -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection



