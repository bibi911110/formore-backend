@extends('layouts.app')

@section('title','Business Admin Performance')

@section('content')

   <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Report</strong> </h2>
      </div>
      <div class="row">
        
        {!! Form::open(['url' => 'business_admin_performance','method' => 'get']) !!}
        <div class="form-group col-md-3">
            {!! Form::label('from_date', 'From Date:') !!}
            {!! Form::text('from_date', $fromDate, ['class' => 'form-control input-datepicker22 start_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('to_date', 'To Date:') !!}
            {!! Form::text('to_date', $toDate, ['class' => 'form-control input-datepickerStart end_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        
        <div class="form-group col-md-3" style="margin-top: 2%;">
          {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
          <!-- <a href="#" class="btn btn-primary">Export Excel</a> -->
          <a href="{{ url('user_report') }}" class="btn btn-default">Clear</a>
        </div>
        <div class="form-group col-md-3" style="margin-top: 2%;">
          <button type="button" class="btn btn-primary" onclick="getExcel()" style="">Export Excel</button>
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

                      <th class="text-center">From</th>

                      <th class="text-center">To</th>

                      <th class="text-center">Branch</th>
                  
                      <th class="text-center">Stamps</th>
                      <th class="text-center">Points</th>
                      <th class="text-center">Free Voucher</th>
                      <th class="text-center">Super Deal</th>
                      <th class="text-center">Super Code</th>
                      <th class="text-center">Birthday</th>
                      <th class="text-center">Welcome</th>
              

                      

                  </tr>

              </thead>

              <tbody>
                <tr>
                    <td><center><?php if($fromDate != '') {echo $fromDate;} else {  echo Carbon\Carbon::today()->toDateString(); } ?></td>
                    <td><center><?php if($toDate != '') {echo $toDate;} else {  echo Carbon\Carbon::today()->toDateString(); } ?></td>
                    <td><center>{{$business_details->name}}</center></td>
                    <td><center>{{$rewardsStamp->totalStamp}}</center></td>
                    <td><center>{{$rewardsPoint->totalPoint}}</center></td>
                    <td><center>{{$freeVoucher->totalFreeVoucher}}</center></td>
                    <td><center>{{$superDeal->totalSuperDeal}}</center></td>
                    <td><center>{{$superCode->totalSuperCode}}</center></td>
                    <td><center>{{$birthdayCount->totalBirthday}}</center></td>
                    
                    <td><center>{{$welcomeCount->totalWelcome}}</center></td>
                </tr>           

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

function getExcel() {
    //alert("ddd");

        start_date = $(".start_date").val();
        if (start_date == '') {
            start_date = '0'
        }
        end_date = $(".end_date").val();
        if (end_date == '') {
            end_date = '0'
        }
        
        window.location.href =  "{{url('business_admin_performance_export')}}" +"/"+ start_date + "/" + end_date;
    }

</script>
@endpush

