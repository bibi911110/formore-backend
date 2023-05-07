@extends('layouts.app')
@section('title','Transaction')
@section('content')
 <div class="block full">
      <div class="block-title">

          <h2><strong>Report</strong> </h2>
      </div>
      <div class="row">
        {!! Form::open(['url' => 'transaction_report_find']) !!}
        <?php $business = \App\Models\Brand::where('type','1')->select('name','id')->get();; 
               $brand = \App\Models\Brand::where('type','2')->select('name','id')->get();;
            ?>
    <?php $user_data = \App\User::where('role_id','4')->pluck('name','id'); ?>
        <div class="form-group col-md-3">
          {!! Form::label('user_id', 'User Name:') !!}
          {!! Form::select('user_id', [''=>'Select User '] + $user_data->toArray(), null, ['class' => 'form-control ','id' => 'unique_no']) !!}
        </div>
     <div class="form-group col-md-3">
          {!! Form::label('business', 'Business:') !!}
          <select class="form-control buss_id_country" name="buss_id" id="buss_id">
             <option value="">Select Business</option>
             <option value="0">All</option>
             <?php foreach ($business as $key => $value) { ?>
            <option value="{{ $value->id }}">{{ $value->name }}</option> 
             <?php } ?>
         </select>
          
          
       </div>
       <div class="form-group col-md-3">
          {!! Form::label('brand', 'Brand:') !!}
          <select class="form-control buss_id_country" name="brand_id" id="buss_id">
             <option value="">Select Brand</option>
             <option value="0">All</option>
             <?php foreach ($brand as $key => $value) { ?>
            <option value="{{ $value->id }}">{{ $value->name }}</option> 
             <?php } ?>
         </select>
         
       </div>
       <div class="form-group col-md-3">
            {!! Form::label('from_date', 'From Date:') !!}
            {!! Form::text('from_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('to_date', 'To Date:') !!}
            {!! Form::text('to_date', null, ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
           
        </div>
       <div class="form-group col-md-3" style="margin-top: 2%;">
          {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
          <!-- <a href="#" class="btn btn-primary">Export Excel</a> -->
          <a href="{{ url('transaction_report') }}" class="btn btn-default">Clear</a>
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
                      <th class="text-center">Business</th>
                      <th class="text-center">User</th>                     
                      <th class="text-center">Transaction Type</th>                     
                      <th class="text-center">Stamps</th>                     
                      <th class="text-center">Points</th>                     
                      <th class="text-center">Date</th>                     
                </tr>
              </thead>
              <tbody>
                @if(!empty($data))
                <?php $i=1; ?>
                  @foreach ($data as $key => $transaction)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $transaction->brandName }}</td>
                      <td class="text-center">{{ $transaction->username }}</td>
                      <td class="text-center">{{ $transaction->transaction }}</td>
                      <td class="text-center">{{ $transaction->point_per_stamp }}</td>
                      <td class="text-center">{{ $transaction->current_point }}</td>
                      <td class="text-center">{{date('d-m-Y',strtotime($transaction->created_at))}}</td>
                      <!-- <td class="text-center">{{date('d-m-Y',strtotime($transaction['created_at']))}}</td> -->
                    
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
                $("#business_data").append('<option value="0">All</option>');
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
                $("#brand_data").append('<option value="0">All</option>');
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

