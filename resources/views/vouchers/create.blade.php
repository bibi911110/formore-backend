@extends('layouts.app')
@section('title','Create Voucher')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Create New </strong> Voucher</h2>
                </div>

                    {!! Form::open(['route' => 'vouchers.store','name' => 'voucherForm','files' => true]) !!}

                        @include('vouchers.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
  
@endsection
@push('scripts')
<script type="text/javascript">
   
$('.buss_id_country').on('load change',function(){
    var buss_id_country = $(this).val();
    //alert(buss_id_country)
    if(buss_id_country){
        $.ajax({
           type:"GET",
           url:"{{url('get-country-list')}}?buss_id_country="+buss_id_country,
           success:function(res){
            if(res){
                $("#country_data").empty();
                //$("#country_data").append('<option value="">Select Category</option>');
                $.each(res,function(key,value){
                    $("#country_data").append('<option value="'+key+'">'+value+'</option>');
                    $("#country_data_id").val(key);
                });
                //$('select').niceSelect('update');
            }else{
               $("#country_data").empty();
            }
           }
        });
    }else{
        $("#country_data").empty();
    }
});

$('#entry_option').on('load change',function(){
   var entry_option = $(this).val();
   var category_ids = $(".cat_id").val()
   var campaign_type_id = $("#campaign_type").val()
   var lotery_type = $("#lotery_point").val()

   var scenario_type_ids = $(this).val();
   
   //alert(category_ids);
   if(campaign_type_id == '1' && entry_option == '2')
   {
       $("#random_win_status").show();
   }
   else
   {
       $("#random_win_status").hide();
   }

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
   

   if(category_ids == '3')
   {
    if(campaign_type_id == '3' && lotery_type == 'point')
       {
           if(entry_option == '1')
            //alert("if");
            {
                //alert("dddddd")
                $('#point_excel').show();
                $('#random_win').hide();
                $("#point_value").hide();
                $('#free_supercode').hide();
                $('#free_voucher').hide();  
            }
            else
            {
                //alert("else");
                $('#point_excel').hide();
                $("#point_value").show();
                $('#random_win').hide();
                $('#free_supercode').hide();
                $('#free_voucher').hide();  
            }
       }
       /* else
       {
            $('#free_supercode').hide();
            $('#free_voucher').hide();
            $('#random_win').hide();
       } */
       
       else if(campaign_type_id == 1)
       {
            $('#random_win').show();
            $('#free_supercode').hide();
            $('#free_voucher').hide();
            $("#point_excel").hide();
       }

       else
       {   
            if(campaign_type_id == 4 && scenario_type_ids == 1)
            {
                $('#free_supercode').show();
                $('#free_voucher').hide();
                $('#random_win').hide();
                $("#point_excel").hide();
            }
            else
            {
                $('#free_supercode').show();
                $('#free_voucher').hide();
                $('#random_win').hide();
                $("#point_excel").hide();
            }
       } 
   }
   else
   {    
          $("#point_excel").hide();
          $('#free_supercode').hide();
          $('#random_win').hide();
          $('#free_voucher').show();
   }
});

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

$('#campaign_type').on('load change',function(){
   var campaign_type = $(this).val();
   if(campaign_type == '4')
   {
          $('#max_member').show();
          $("#scenario_type").show();
   }
   else
   {
          $('#max_member').hide();
          $("#scenario_type").hide();
   }
});

$('#scenario_type_id').on('load change',function(){
   var scenario_type_id = $(this).val();
   if(scenario_type_id == '2')
   {    
       $('#manual').show();
       $("#optionId").hide();
       $("#optionIdVal").val('2');
       $("#optionIdVal").prop('disabled', false);
       $('#scenario_2_excel').show();
   }
   else
   {
       $('#manual').hide();
       $("#optionId").show();
       $("#optionIdVal").prop('disabled', true);
       $("#scenario_2_excel").hide();
   }
});


</script>

<script type="text/javascript">
    
$('#category_id').on('load change',function(){

   var category_id = $(this).val();
    //alert(campaign_type);
    if(category_id == '2')
    {
        var buss_id = $("#buss_id").val();
        //alert(buss_id);
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
                            alert(res.level.levels_based_on_scenarios);
                            //var countScheme = res.level.schema + 1
                            for(i=0;i<=res.level.levels_based_on_scenarios;i++)
                            {
                              //alert(i)
                              $("#levels_based_on_scenarios").append('<option value="'+i+'">'+i+'</option>');
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



$('#campaign_type').on('load change',function(){

   var category_id = $(this).val();
    //alert(campaign_type);
    if(category_id == '3')
    {
        var buss_id = $("#buss_id").val();
        //alert(buss_id);
            if(buss_id){
                $.ajax({
                type:"GET",
                url:"{{url('get-business-point-details')}}?business_id="+buss_id,
                success:function(res){
                    if(res){
                        console.log(res);            
                        if(res.point == '2')
                        {
                            $("#lotery_point").val('point');
                            //$("#levels_based_on_scenarios").empty();
                            //alert(res.level.schema);
                            //var countScheme = res.level.schema + 1
                            /*$.each(res.level,function(key,value){
                                $("#levels_based_on_scenarios").append('<option value="'+key+'">'+value+'</option>');
                            });*/
                            //$("#Scenarios").show()
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

$(document).ready(function(){

$(".input-datepicker22").datepicker({
    //todayBtn:  1,
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

</script>
@endpush
