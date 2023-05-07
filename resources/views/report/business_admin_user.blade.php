@extends('layouts.app')

@section('title','Business Admin User')

@section('content')

   <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Report</strong> </h2>
      </div>
      <div class="row">
        
        {!! Form::open(['url' => 'business_admin_use','method' => 'get']) !!}
        <div class="form-group col-md-2">
            {!! Form::label('from_date', 'From Date:') !!}
            {!! Form::text('from_date', $fromDate, ['class' => 'form-control input-datepicker22 start_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('to_date', 'To Date:') !!}
            {!! Form::text('to_date', $toDate, ['class' => 'form-control input-datepickerStart end_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('to_date', 'User:') !!}
            <select class="form-control" name="user_id">
                <option value="">Select User</option>
                <?php

                foreach ($userData_dropdown as  $value) {?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name'].'-'.$value['unique_no']; ?></option>
                <?php } ?>
                ?>
           </select>
        </div>
        
        <div class="form-group col-md-2" style="margin-top: 2%;">
          {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
          <!-- <a href="#" class="btn btn-primary">Export Excel</a> -->
          <a href="{{ url('business_admin_use') }}" class="btn btn-default">Clear</a>
        </div>
        <div class="form-group col-md-2" style="margin-top: 2%;">
          <button type="button" class="btn btn-primary" onclick="exportexcel()" style="">Export Excel</button>
        </div>
       <!--  <div class="form-group col-md-3" style="margin-top: 2%;">
          <button type="button" class="btn btn-primary" onclick="getExcel()" style="">Export Excel</button>
        </div> -->
      {!! Form::close() !!}

      </div>

        @include('flash::message')


      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">

              <thead>

                  <tr>
                      <th class="text-center">From</th>
                      <th class="text-center">To</th>
                      <th class="text-center">Branch</th>
                      <th class="text-center">User Id</th>
                      <th class="text-center">User Name</th>
                      <th class="text-center">Stamp</th>
                      <th class="text-center">Free Voucher</th>
                      <th class="text-center">Super Code</th>                      
                  </tr>

              </thead>

              <tbody>
                <?php if(!empty($userData)) {
                    foreach ($userData as $value) {
                        // code...
                    
                 ?>
                <tr>
                    <td><center><?php if($fromDate != '') {echo $fromDate;} else {  echo Carbon\Carbon::today()->toDateString(); } ?></td>
                    <td><center><?php if($toDate != '') {echo $toDate;} else {  echo Carbon\Carbon::today()->toDateString(); } ?></td>
                    <td><center><?php echo $business_details['name']; ?></td>
                    <td><center><?php echo $value['unique_no']; ?></td>
                    <td><center><?php echo $value['name']; ?></td>
                    <td><center><?php
                    if(isset($from_date) && $from_date != '' && isset($to_date) && $to_date != ''&& isset($user_id) && $user_id != '')
                    {
                        $stampCount =  \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                    ->whereDate('created_at','>=', $fromDate)
                                    ->whereDate('created_at','<=', $toDate)            
                                    ->where('user_id',$value['id'])
                                    ->count();
                        echo $stampCount;

                        
                        
                    }
                    else if(isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '')
                    {
                        $stampCount =  \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                    ->whereDate('created_at','>=', $fromDate)
                                    ->whereDate('created_at','<=', $toDate)            
                                    ->where('user_id',$value['id'])
                                    ->count();
                        echo $stampCount;
                    }
                    else if(isset($user_id) && $user_id != '')
                    {
                        $stampCount =  \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)
                                    ->where('user_id',$value['id'])
                                    ->count();
                        echo $stampCount;
                    }
                    else
                    {
                        $stampCount =  \App\Models\Transaction_history::where('buss_id',Auth::user()->userDetailsId)            
                                    ->where('user_id',$value['id'])
                                    ->count();
                        echo $stampCount;
                    }
                     ?></td>
                     <td><center><?php 
                        
                    if(isset($from_date) && $from_date != '' && isset($to_date) && $to_date != ''&& isset($user_id) && $user_id != '')
                    {
                        $voucherCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','1')
                        ->whereDate('voucher.created_at','>=', $fromDate)
                        ->whereDate('voucher.created_at','<=', $toDate)
                        ->count();

                        echo $voucherCount;                        
                        
                    }
                    else if(isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '')
                    {
                        $voucherCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','1')
                        ->whereDate('voucher.created_at','>=', $fromDate)
                        ->whereDate('voucher.created_at','<=', $toDate)
                        ->count();

                        echo $voucherCount;                        
                    }
                    else if(isset($user_id) && $user_id != '')
                    {   
                        $voucherCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','1')
                        ->count();

                        echo $voucherCount;                        
                        
                    }
                    else
                    {
                       $voucherCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','1')
                        ->count();
                        echo $voucherCount;
                    }
                     ?>
                        
                    </td>
                     <td><center><?php 
                     if(isset($from_date) && $from_date != '' && isset($to_date) && $to_date != ''&& isset($user_id) && $user_id != '')
                    {
                        $superCodeCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','3')
                        ->whereDate('voucher.created_at','>=', $fromDate)
                        ->whereDate('voucher.created_at','<=', $toDate)
                        ->count();

                        echo $superCodeCount;

                                               
                        
                    }
                    else if(isset($from_date) && $from_date != '' && isset($to_date) && $to_date != '')
                    {
                        $superCodeCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','3')
                        ->whereDate('voucher.created_at','>=', $fromDate)
                        ->whereDate('voucher.created_at','<=', $toDate)
                        ->count();  
                        echo $superCodeCount;                      
                    }
                    else if(isset($user_id) && $user_id != '')
                    {   
                        $superCodeCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','3')
                        
                        ->count();     
                        echo $superCodeCount;                  
                        
                    }
                    else
                    {
                       $voucherCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','1')
                        ->count();
                        echo $voucherCount;
                    }
                        /*$superCodeCount = \App\Models\Voucher::join('voucher_upload_receipt','voucher.id','voucher_upload_receipt.voucher_id')
                        ->where('voucher_upload_receipt.business_id',Auth::user()->userDetailsId)
                        ->where('voucher_upload_receipt.user_id',$value['id'])
                        ->where('voucher.category_id','3')
                        ->count();

                        echo $superCodeCount;*/
                     ?></td>
                    
                </tr>           
            <?php }
                }
             ?>

              </tbody>

          </table>

      </div>

  </div>

  <!-- END Datatables Content -->

@endsection
@push('scripts')
 <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
 <script>$(function(){ TablesDatatables.init(); });</script>
 <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script type="text/javascript">
        function exportexcel() {  
            var names = Math.random().toString(36).substr(2,13);
            
            $("#example-datatable").table2excel({
                filename: names+".xls"
            });
        }  
</script>       

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

