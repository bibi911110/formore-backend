@extends('layouts.app')

@section('title','User Report')

@section('content')

   <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Report</strong> </h2>
      </div>
      <div class="row">
        {!! Form::open(['url' => 'user_report_find']) !!}
        <div class="form-group col-md-3">
            {!! Form::label('from_date', 'From Date:') !!}
            {!! Form::text('from_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('to_date', 'To Date:') !!}
            {!! Form::text('to_date', null, ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
         <div class="form-group col-md-3">
            {!! Form::label('reg_date', 'Registration date:') !!}
            {!! Form::text('reg_date', null, ['class' => 'form-control input-datepickerreg','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <?php $country_data = \App\Models\Country::where('status','1')->select('country_name','id')->get(); ?>
        <div class="form-group col-md-3">
          {!! Form::label('country_id', 'Country:') !!}

          <select class="form-control buss_id_country" id="buss_id" name="country_id">
              <option value="">Select Country</option>
              <option value="0">All</option>
              <?php foreach ($country_data as $country) { ?>
                  <option value="<?php echo $country['id']; ?>"><?php echo $country['country_name']; ?></option>
              <?php } ?>
          </select>
          <!-- {!! Form::label('country_id', 'Country:') !!}
          {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!} -->
        </div>

       <!--  <div class="form-group col-md-3">
          {!! Form::label('city', 'City:') !!}
          {!! Form::text('city', null, ['class' => 'form-control']) !!}
        </div> -->
        <div class="form-group col-md-3">
            {!! Form::label('birth_date', 'Birthday:') !!}
            {!! Form::text('birth_date', null, ['class' => 'form-control input-datepickerbirth','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}           
        </div>

         <!-- <div class="form-group col-md-3">
          {!! Form::label('sex', 'Sex:') !!}
          {!! Form::text('sex', null, ['class' => 'form-control']) !!}
        </div>  
        <div class="form-group col-md-3">
          {!! Form::label('transaction_type', 'Transaction:') !!}
          {!! Form::text('transaction_type', null, ['class' => 'form-control']) !!}
        </div> -->

        <!-- <div class="form-group col-md-3">
          {!! Form::label('business', 'Business:') !!}
          {!! Form::text('business', null, ['class' => 'form-control']) !!}
        </div> -->
        <!-- <div class="form-group col-md-3">
          {!! Form::label('business', 'Business:') !!}
          {!! Form::select('business', [''=>'Select Business'],null,['class' => 'form-control','id'=>'business_data']) !!}
          
       </div>
       <div class="form-group col-md-3">
          {!! Form::label('brand', 'Brand:') !!}
          {!! Form::select('brand', [''=>'Select Brand'],null,['class' => 'form-control','id'=>'brand_data']) !!}
          
       </div> -->

       <!--  <div class="form-group col-md-3">
          {!! Form::label('brand', 'Brand:') !!}
          {!! Form::text('brand', null, ['class' => 'form-control']) !!}
        </div> -->
        <div class="form-group col-md-3">
          {!! Form::label('sex', 'Sex:') !!}
          {!! Form::select('sex', [''=>'Select Sex',"1" => 'Male','2' => 'Female','3' => 'Other'], null, ['class' => 'form-control','id' => 'levels_based']) !!}
        </div> 

        <div class="form-group col-md-3">
          {!! Form::label('marital_status', 'Marital status:') !!}
          {!! Form::select('marital_status', [''=>'Select Marital status',"1" => 'Married','2' => 'Not Married'], null, ['class' => 'form-control','id' => 'levels_based']) !!}
        </div> 
       <div class="form-group col-md-3">
          {!! Form::label('no_kids', 'Kids:') !!}
          {!! Form::select('no_kids', [''=>'Select Kids',"0" => '0',"1" => '1','2' => '2','3' => '3'], null, ['class' => 'form-control','id' => 'levels_based']) !!}
       </div>
        <?php $lang_data = \App\Models\Language::where('status','1')->pluck('language_name','id'); ?>
        <div class="form-group col-md-3">
          {!! Form::label('lang_id', 'Language:') !!}
          {!! Form::select('lang_id', [''=>'Select Language'] + $lang_data->toArray(), null, ['class' => 'form-control ','id' => 'lang_id']) !!}
        </div>

        <?php $user_data = \App\User::where('role_id','4')->where('unique_no','!=','NULL')->pluck('unique_no','unique_no'); ?>
        <div class="form-group col-md-3">
          {!! Form::label('unique_no', 'User Id:') !!}
          {!! Form::select('unique_no', [''=>'Select User Id'] + $user_data->toArray(), null, ['class' => 'form-control ','id' => 'unique_no']) !!}
        </div>

         <div class="form-group col-md-3">
          {!! Form::label('Entartainment', 'Entartainment:') !!}
          {!! Form::select('entartainment', [''=>'Select Entartainment ',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div> 

         <div class="form-group col-md-3">
          {!! Form::label('Sports', 'Sports:') !!}
          {!! Form::select('sports', [''=>'Select Sports',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div> 

         <div class="form-group col-md-3">
          {!! Form::label('Technolocgy', 'Technolocgy:') !!}
          {!! Form::select('technolocgy', [''=>'Select Technolocgy',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div> 

         <div class="form-group col-md-3">
          {!! Form::label('Music', 'Music:') !!}
          {!! Form::select('music', [''=>'Select Music',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-3">
          {!! Form::label('Travelings', 'Travelings:') !!}
          {!! Form::select('travelings', [''=>'Select Travelings',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-3">
          {!! Form::label('Electronic Games', 'Electronic Games:') !!}
          {!! Form::select('electronic_games', [''=>'Select Electronic Games',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-3">
          {!! Form::label('Food', 'Food:') !!}
          {!! Form::select('food', [''=>'Select Food',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div>

         <div class="form-group col-md-3">
          {!! Form::label('Night Life', 'Night Life:') !!}
          {!! Form::select('nightlife', [''=>'Select Night Life',"1" => 'Yes','Null' => 'No'], null, ['class' => 'form-control']) !!}
        </div>     

        <div class="form-group col-md-3" style="margin-top: 2%;">
          {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
          <!-- <a href="#" class="btn btn-primary">Export Excel</a> -->
          <a href="{{ url('user_report') }}" class="btn btn-default">Clear</a>
      </div>
      {!! Form::close() !!}

      </div>

        @include('flash::message')


      <div class="table-responsive">
         @if(!empty($data))
            <a class="btn btn-primary pull-right" download ="{{$basename}}" href="{{$exce_download_url}}">Download</a>
            @endif
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">

              <thead>

                  <tr>

                      <th class="text-center">No</th>

                      <th class="text-center">Name</th>

                      <th class="text-center">Email</th>
                  
                      <th class="text-center">View</th>
              

                      <th class="text-center">Actions</th>

                  </tr>

              </thead>

              <tbody>


                  <?php $i=1;  ?>
                  @if(!empty($data))
                  @foreach ($data as $key => $user)

                    <tr>

                      <td class="text-center">{{$i++ }}</td>

                      <td class="text-center">{{ $user->name }}</td>

                      <td class="text-center">{{ $user->email }}</td>
            
        
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$i}}">User Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>User Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <h4>Personal Data</h4>
                                          <div> <b>User ID - </b>{{$user->unique_no}}</div><hr>
                                          <div> <b>Name/Surname - </b>{{$user->name}}</div><hr>
                                          <div> <b>Date Of Birth - </b>{{date('d-m-Y',strtotime($user->birth_date))}}</div><hr>
                                          <div> <b>Residence Country - </b><?php $country = \App\Models\Country::where('id',$user->residence_country_id)->select('country_name','country_code')->first(); 
                                                if(!empty($country))
                                                {
                                                  echo $country['country_code'] .' '. $country['country_name']; 
                                                }
                                                else
                                                {
                                                  echo "NA";
                                                }

                                                ?></div><hr>
                                        <div> <b>City - </b>{{$user->city}}</div><hr>
                                        <div> <b>Mobile Number - </b>{{$user->mobile_no}}</div><hr>
                                        <div> <b>Email - </b>{{$user->email}}</div><hr>
                                        <div> <b>Sex - </b><?php if($user->sex == '1'){ echo "Male";}elseif($user->sex == '2'){ echo "Female";} else{
                                          echo "Other";
                                        }  ?>
                                        </div><hr>
                                        <div>
                                           <b>Marital Status - </b><?php if($user->marital_status == '1'){ echo "Married ";}else{ echo "Unmarried ";}  ?>
                                        </div><hr>
                                         <div>
                                           <b>Kids - </b><?php if($user->no_kids != ''){ 
                                                echo $user->no_kids;}else{
                                                echo "No Data";
                                        }  ?>
                                        </div><hr>
                                      </div>
                                    
                                     <div class="col-md-4">
                                        <h4>Interests</h4>
                                        <div><b>Entartainment - </b><?php if($user->entartainment == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Sports - </b><?php if($user->sports == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Technolocgy - </b><?php if($user->technolocgy == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Music - </b><?php if($user->music == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Travelings - </b><?php if($user->travelings == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Electronic Games - </b><?php if($user->electronic_games == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Food - </b><?php if($user->food == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Night Life - </b><?php if($user->nightlife == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>

                                      </div>
                                      <div class="col-md-4">
                                        <h4>Other</h4>
                                         <div> <b>Date Of Registration - </b>{{date('d-m-Y',strtotime($user->created_at))}}</div><hr>
                                      </div>

                              </div>
                                  <div class="row">
                                    <div class="col-md-6">  
                                      <b>Bar Code - </b> <a download ="{{$user->bar_code}}" href="<?php echo $user->bar_code; ?>"><img src="<?php echo  url('/').'/'.$user->bar_code; ?>" style="width: 50%; height:50%;"  ></a>
                                    </div>
                                    <div class="col-md-6">
                                      <b>QR Code - <a download="{{$user->qr_code}}" href="<?php echo $user->qr_code; ?>"><img src="<?php echo  url('/').'/'.$user->qr_code; ?>" style="width: 30%"  ></a></b>
                                    </div>
                                  </div>
                                  <hr>
                            </div>
                                  
                                
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button"  class="btn btn-default pull-left" style="background-color:white;"><a href="{{ url('user_export_report',['id' => $user->id]) }}">Export</a></button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      </td>
                    
                      <td class="text-center">
                          {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <!-- <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> -->
                                @if($user->id != 1)
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                            @endif
                      </td>
                    </tr>

                  @endforeach
                  @endif

                                

              </tbody>

          </table>

      </div>

  </div>

  <!-- END Datatables Content -->

@endsection
@push('scripts')
 <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
 <script>$(function(){ TablesDatatables.init(); });</script>
<script type="text/javascript">
    
$(document).ready(function(){

$(".input-datepicker22").datepicker({
    todayBtn:  "linked",
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerStart').datepicker('setStartDate', minDate);
    $('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});

$(".input-datepickerStart").datepicker({
    todayBtn:  "linked",
}).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('.input-datepicker22').datepicker('setEndDate', maxDate);
});

$(".input-datepickerreg").datepicker({
    todayBtn:  "linked",
    autoclose: true,
})/*.on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerStart').datepicker('setStartDate', minDate);
    $('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});*/
$(".input-datepickerbirth").datepicker({
    todayBtn:  "linked",
    autoclose: true,
})/*.on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerStart').datepicker('setStartDate', minDate);
    $('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});*/

});

 
$('.buss_id_country').on('load change',function(){
    var country_id = $(this).val();
   // alert(country_id)
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get_country_buss_list')}}?country_id="+country_id,
           success:function(res){
            if(res){
                $("#business_data").empty();
                $("#business_data").append('<option value="">Select Business</option>');
                $.each(res,function(key,value){
                    $("#business_data").append('<option value="'+key+'">'+value+'</option>');
                    $("#business_data_id").val(key);
                });
                //$('select').niceSelect('update');
            }else{
               $("#business_data").empty();
            }
           }
        });
    }else{
        $("#business_data").empty();
    }
});
$('.buss_id_country').on('load change',function(){
    var country_id = $(this).val();
   // alert(country_id)
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get_country_brand_list')}}?country_id="+country_id,
           success:function(res){
            if(res){
                $("#brand_data").empty();
                $("#brand_data").append('<option value="">Select Brand</option>');
                $.each(res,function(key,value){
                    $("#brand_data").append('<option value="'+key+'">'+value+'</option>');
                    $("#brand_data_id").val(key);
                });
                //$('select').niceSelect('update');
            }else{
               $("#brand_data").empty();
            }
           }
        });
    }else{
        $("#business_data").empty();
    }
});


</script>
@endpush

