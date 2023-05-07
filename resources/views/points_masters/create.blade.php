@extends('layouts.app')
@section('title','Points Master')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Points Master</h2>
            </div>

            {!! Form::open(['route' => 'pointsMasters.store', 'files' => true]) !!}

                        @include('points_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">

$(document).ready(function() {
    $("input[name$='campaign']").click(function() {
        var test = $(this).val();
        if(test == 1)
        {
            $('#show_cap').show();

        }else if(test == 0){
            $('#show_cap').hide();
        }        
    });
});

$(document).ready(function() {
    $("input[name$='birthday']").click(function() {
        var test = $(this).val();
        //alert(test)
        if(test == 1)
        {
            $('#birthday_data').show();

        }else if(test == 0){
            $('#birthday_data').hide();
        }        
    });
});
$(document).ready(function() {
    $("input[name$='welcome']").click(function() {
        var test = $(this).val();
       // alert(test)
        if(test == 1)
        {
            $('#welcome_data').show();

        }else if(test == 0){
            $('#welcome_data').hide();
        }        
    });
});

$('#amount_type').on('load change',function(){
   var amount_type = $(this).val();
   if(amount_type == '1')
   {
        $('#show_pr').show();
        $('#show_amount').hide();       
   }
   else
   {
        $('#show_pr').hide();
        $('#show_amount').show();       
   }
});

$('#schema').on('load change',function(){
   var schema = $(this).val();
   if(schema == '1')
   {    
        $('#win_direct_point').show();
        $('#Scenarios').hide();       
   }
   else
   {
        $('#win_direct_point').hide();
        $('#Scenarios').show();       
   }
});
$('#levels_based').on('load change',function(){
   var levels_based = $(this).val();
   // alert(levels_based)
   if(levels_based == '0')
   {
        $('#levels_0').show();       
        $('#levels_1').hide();       
        $('#levels_2').hide();       
        $('#levels_3').hide();       
        $('#levels_4').hide();       
   }
   if(levels_based == '1')
   {
        $('#levels_0').show();       
        $('#levels_1').show();       
        $('#levels_2').hide();       
        $('#levels_3').hide();       
        $('#levels_4').hide();       
   }
   if(levels_based == '2')
   {
        $('#levels_0').show();       
        $('#levels_1').show();       
        $('#levels_2').show();       
        $('#levels_3').hide();       
        $('#levels_4').hide();       
   }
   if(levels_based == '3')
   {
        $('#levels_0').show();       
        $('#levels_1').show();       
        $('#levels_2').show();       
        $('#levels_3').show();       
        $('#levels_4').hide();       
   }
   if(levels_based == '4')
   {
        $('#levels_0').show();       
        $('#levels_1').show();       
        $('#levels_2').show();       
        $('#levels_3').show();       
        $('#levels_4').show();       
   }
})


 $('#select_all').click(function() {
      $('#example-chosen-multiple option').prop('selected', true);
    });
 $('#select_all_c').click(function() {
      $('#example-chosen-multiple-c option').prop('selected', true);
    });
$('#select_all_welcome').click(function() {
      $('#example-chosen-multiple-w option').prop('selected', true);
    });
</script>

<script type="text/javascript">

    $(function () {
        //default item html for render
        

    
        //$('.select2').select2()
        //$('.select-chosen').trigger("chosen:updated");  
        //$('.select-chosen').chosen({width: "100%"});
        
        $('.add_item').hide();
        $('.remove_item').show();
        $('.add_item:last').show();
       
        if($('.remove_item').length == 1){
            $('.remove_item').hide();
        }
        //Delete item onclick event
        $('body').on('load click','.remove_item', function(){
            var itemId = $(this).attr('data-item-id');
            $('#' + itemId).remove();
            $('.add_item').hide();
            $('.remove_item').show();
            $('.add_item:last').show();

            //we will hide remove button if have only single record
            if($('.remove_item').length == 1){
                $('.remove_item').hide();
            }
        })
        
        $('body').on('click','.add_item', function(){
          //itemHtml
          var itemHtml = '<div class="row itemClass" id="item_<?php echo 1 + 1; ?>"><div class="col-md-3"><div class="form-group"><label for="institute_name">Segments Name</label>{!! Form::select('segments_id[]', [''=>'Select Segments'] + $segment_data->toArray(), null, ['class' => 'form-control']) !!} </div></div><div class="col-md-3"><div class="form-group">   {!! Form::label('segments_based_on_scenarios', 'Segment Based On Scenarios:') !!}{!! Form::select('segments_based_on_scenarios[]', [''=>'Select Schema',"0" => '0','1' => '1',"2" => '2',"3" => '3',"4" => '4'], null, ['class' => 'form-control']) !!}     </div> </div> <div class="col-md-3"><div class="form-group"><label for="amount">Amount</label>{!! Form::text('amount[]', null, ['class' => 'form-control']) !!}</div></div><div class="col-md-2" style="margin-top: 20px;"><div class="input-group-btn"><button class="btn btn-danger remove_item" data-item-id="item_<?php echo 1 + 1; ?>" type="button"><i class="fa fa-minus"></i> </button><button class="btn btn-success add_item" data-item-id="item_<?php echo 1 + 1; ?>" type="button" style="margin-left: 2%;"><i class="fa fa-plus"></i></button></div></div></div><div class="clear"></div>';  
          var totalRecords = $('.itemClass').length + 1;      
          var itemNewContent = itemHtml.replace(/sec_dynamic_id/g, totalRecords);
          var itemId = $(this).attr('data-item-id');
         // console.log(itemNewContent)
          $('#' + itemId).after(itemNewContent);
          $(".select-chosen").chosen();
          $('.add_item').hide();
          $('.remove_item').show();
          $('.add_item:last').show();          
        }) 

        
   });   
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


$(document).ready(function(){

$(".point_start_date").datepicker({
    todayBtn:  1,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.point_end_date').datepicker('setStartDate', minDate);
    $('.point_end_date').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});

$(".point_end_date").datepicker()
    .on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('.point_start_date').datepicker('setEndDate', maxDate);
    });

$(".expiration_date").datepicker()
   // .on('changeDate', function (selected) {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
       // var maxDate = new Date(selected.date.valueOf());
        $('.expiration_date').datepicker('setStartDate', today);
  //  });

});
</script>
@endpush

