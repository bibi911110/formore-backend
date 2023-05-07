@extends('layouts.app')

@section('title','Business Admin Performance')

@section('content')

   <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Report</strong> </h2>
      </div>
      <div class="row">
        
        {!! Form::open(['url' => 'business_admin_appointment','method' => 'get']) !!}
        <div class="form-group col-md-2">
            {!! Form::label('from_date', 'From Date:') !!}
            {!! Form::text('from_date', $fromDate, ['class' => 'form-control input-datepicker22 start_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('to_date', 'To Date:') !!}
            {!! Form::text('to_date', $toDate, ['class' => 'form-control input-datepickerStart end_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('status', 'Select Status:') !!}
    {!! Form::select('status', [''=>'Select Status','Open' => 'Open',"Confirm" => 'Confirm',"Reschedule" => 'Reschedule',"Cancel" =>'Cancel'], $status, ['class' => 'form-control','id' => 'campaign_type']) !!}
        </div>
        <div class="form-group col-md-2" style="margin-top: 2%;">
          {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
          <!-- <a href="#" class="btn btn-primary">Export Excel</a> -->
          <a href="{{ url('business_admin_appointment') }}" class="btn btn-default">Clear</a>
        </div>
        <div class="form-group col-md-2" style="margin-top: 2%;">
          <button type="button" class="btn btn-primary" onclick="exportexcel()" style="">Export Excel</button>
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
                      <th class="text-center">Status</th>
                      <th class="text-center">User ID</th>
                      <th class="text-center">User Name</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Value</th>
                      <th class="text-center">Payment Type</th>
                      
                  </tr>

              </thead>

              <tbody>
                <?php foreach($appointment_data as $value) { ?>
                <tr>
                    <td><center><?php if($fromDate != '') {echo $fromDate;} else {  echo Carbon\Carbon::today()->toDateString(); } ?></td>
                    <td><center><?php if($toDate != '') {echo $toDate;} else {  echo Carbon\Carbon::today()->toDateString(); } ?></td>
                    <td><center><?php echo $business_details['name']; ?></td>
                    <td><center><?php echo $value['status']; ?></td>
                    <td><center><?php echo $value['name']; ?></td>
                    <td><center><?php echo $value['unique_no']; ?></td>
                    <td><center>
                        <?php 
                        $cart_extra_details = \App\Models\Services_product::
                                               leftjoin('booking_add_cart_time_order','services_product.id','booking_add_cart_time_order.product_id')
                                               ->leftjoin('order_cart_extra_details','services_product.id','order_cart_extra_details.product_id')
                                               ->leftjoin('extra_services','order_cart_extra_details.extra_id','extra_services.id')
                                              ->where('booking_add_cart_time_order.booking_id',$value->id)
                                              //->where('order_cart_extra_details.type','2')
                                              //->groupBy('extra_services.product_id')
                                              ->distinct()
                                               ->select('extra_services.*','order_cart_extra_details.name','services_product.name as product_name','booking_add_cart_time_order.date','booking_add_cart_time_order.time','booking_add_cart_time_order.date')
                                               ->get();
                        foreach ($cart_extra_details as  $valueData) {
                            echo $valueData->product_name.",<br/>";

                        }
                        ?>
                    </center></td>
                  <td><center><?php echo $value['finalcash']; ?></center></td>
                  <td><center>Cash</center></td>
                </tr>           
                <?php } ?>
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

        var status = $("#status").val();
        if (status == '') {
            status = '0'
        }
        
        window.location.href =  "{{url('business_admin_performance_export')}}" +"/"+ start_date + "/" + end_date+"/"+status;
    }

</script>
@endpush

