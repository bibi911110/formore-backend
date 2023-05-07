@extends('layouts.app')
@section('title','Edit Voucher')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Voucher</h2>
                </div>
                   {!! Form::model($voucher, ['route' => ['vouchers.update', $voucher->id], 'method' => 'patch','files' => true]) !!}

                        @include('vouchers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@push('scripts')
<script type="text/javascript">
    
$('#entry_option').on('load change',function(){
    

   var entry_option = $(this).val();
   if(entry_option == '1')
   {
        $('#excel').show();
        $('#manual').hide();
   }
   else
   {
        $('#excel').hide();
        $('#manual').show();
   }
    
});

$(document).ready(function() {
    $('#category_id').on('load change',function(){
        var category_id = $(this).val();
        
    if(category_id == '3')
    {
            $('#campaign_cat').show();
            $('#campaign_start_date').show();
            $('#campaign_end_date').show();
            $('#date_of_campaign').show();
            $('#campaign_code').show();
    }
    else
    {
            $('#campaign_cat').hide();
            $('#campaign_start_date').hide();
            $('#campaign_end_date').hide();
            $('#date_of_campaign').hide();
            $('#campaign_code').hide();        
    }
    });
    $('#category_id').trigger('change');
});
$(document).ready(function() {

    $('#campaign_type').on('load change',function(){
    var campaign_type = $(this).val();
    if(campaign_type == '4')
    {
            $('#max_member').show();    
    }
    else
    {
            $('#max_member').hide();
    }    
    });
    $('#campaign_type').trigger('change');
});
$(document).ready(function(){

$(".input-datepicker22").datepicker({
    todayBtn:  1,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerStart').datepicker('setStartDate', minDate);
    $('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});

$(".input-datepickerStart").datepicker()
    .on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('.input-datepicker22').datepicker('setEndDate', maxDate);
    });

});


$(document).ready(function(){

$(".input-datepickerCampStart").datepicker({
    todayBtn:  1,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerCampEnd').datepicker('setStartDate', minDate);
    $('.input-datepickerCampEnd').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});

$(".input-datepickerCampEnd").datepicker()
    .on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('.input-datepickerCampStart').datepicker('setEndDate', maxDate);
    });

});

$('#category_id').on('load change',function(){

   var category_id = $(this).val();
    //alert(campaign_type);
    if(category_id == '2')
    {
        var buss_id = $("#buss_id").val();
        var e_levels_based_on_scenarios = $("#e_levels_based_on_scenarios").val();
        //alert(e_levels_based_on_scenarios);
            if(buss_id){
                $.ajax({
                type:"GET",
                url:"{{url('get-business-point-stamp')}}?business_id="+buss_id,
                success:function(res){
                    if(res){
                        console.log(res);            
                        if(res.point == '2')
                        {
                            $("#lotery_point").val('point');
                            $("#levels_based_on_scenarios").empty();
                            //alert(res.level.schema);
                            //var countScheme = res.level.schema + 1
                            for(i=0;i<=res.level.levels_based_on_scenarios;i++)
                            {
                              if(e_levels_based_on_scenarios == i)
                              {

                              $("#levels_based_on_scenarios").append('<option value="'+i+'" selected>'+i+'</option>');
                              }
                              else
                                {
                                   $("#levels_based_on_scenarios").append('<option value="'+i+'">'+i+'</option>'); 
                                }
                            } 
                            /*$.each(res.level,function(key,value){
                                $("#levels_based_on_scenarios").append('<option value="'+key+'">'+value+'</option>');
                            });*/
                            $("#Scenarios").show()
                            //$("#lotery_type").
                        }
                        if(res.stamp == '1')
                        {
                            $("#lotery_point").val('stamp');
                        }
                    }else{
                    $(".sub-category").empty();
                    }
                }
                });
            }else{
                $(".sub-category").empty();
            }
    }
    else
    {
      $("#Scenarios").hide()
    }

});
</script>
@endpush
