@extends('layouts.app')
@section('title','Brand')
@section('content')
 <div class="block full">
      <div class="block-title">

          <h2><strong>Report</strong> </h2>
      </div>
      <div class="row">
        {!! Form::open(['url' => 'brand_report_find']) !!}
        <?php $country_data = \App\Models\Country::where('status','1')->select('country_name','id')->get(); ?>
        <div class="form-group col-md-3">
          {!! Form::label('country_id', 'Country:') !!}
         <!--  {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!} -->
         <select class="form-control buss_id_country" name="country_id" id="buss_id">
             <option value="">Select Country</option>
             <option value="0">All</option>
             <?php foreach ($country_data as $key => $value) { ?>
            <option value="{{ $value->id }}">{{ $value->country_name }}</option> 
             <?php } ?>
         </select>
        </div>

        <div class="form-group col-md-3">
          {!! Form::label('business', 'Business:') !!}
          {!! Form::select('business', [''=>'Select Business'],null,['class' => 'form-control','id'=>'business_data']) !!}
          
       </div>
       <div class="form-group col-md-3">
          {!! Form::label('brand', 'Brand:') !!}
          {!! Form::select('brand', [''=>'Select Brand'],null,['class' => 'form-control','id'=>'brand_data']) !!}
          
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
          <a href="{{ url('brand_report') }}" class="btn btn-default">Clear</a>
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
                      <th class="text-center">Code</th>
                      <th class="text-center">Type</th>
                      <!-- <th class="text-center">Position</th> -->
                     <!--  <th class="text-center">Stamp/Point</th> -->
                      <th class="text-center">Name</th>
                      <th class="text-center">Country</th>
                      <th class="text-center">City</th>
                      <!-- <th class="text-center">Sub Category</th> -->
                      <th class="text-center">Category</th>
                      <th class="text-center">Sub Category</th>
                      <th class="text-center">Date</th>
                     <!--  <th class="text-center">Icon</th> -->
                      <!-- <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
 -->                  </tr>
              </thead>
              <tbody>
                @if(!empty($data))
                <?php $i=1; ?>
                  @foreach ($data as $key => $brands)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                     <td class="text-center"><?php if($brands->type == 1){ echo 'Business';}else{ echo 'Brand';} ?></td>
                     <!--  <td class="text-center">{{ $brands->position }}</td> -->
                      <!-- <td class="text-center"><?php if($brands->stamp_point == 1){ echo 'Stamp';}else{ echo 'Point';} ?></td> -->
                       <td class="text-center">{{ $brands->name }}</td>
                       <td class="text-center">{{ $brands->country_name }}</td>
                       <td class="text-center">{{ $brands->city_name }}</td>
                      <td class="text-center">
                        <?php 
                          $categoryData = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$brands->id)->get();
                          foreach ($categoryData as $catData) {
                              $catName = App\Models\Category::where('id',$catData['cat_id'])->first();
                              echo $catName->name.",";  
                              //echo array_unique($cat);
                          }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php 
                          $categoryData = \App\Models\Bussiness_cat_subcat_mapping::where('business_id',$brands->id)->get();

                          foreach ($categoryData as $catData) {
                              $catName = App\Models\Sub_category::where('id',$catData['sub_cat_id'])->first();
                              echo $catName->name.",";  
                          }
                        ?>
                      </td>
                      <td class="text-center">{{date('d-m-Y',strtotime($brands['created_at']))}}</td>
                    
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

