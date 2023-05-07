@extends('layouts.app')
@section('title','Stamp Master')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Stamp Master</h2>
            </div>
                    {!! Form::open(['route' => 'stampMasters.store', 'files' => true]) !!}

                        @include('stamp_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
$('#stapm_point').on('load change',function(){
   var stapm_point = $(this).val();
   if(stapm_point == '1')
   {
        $('#stamp_filed').show();
        $('#points_filed').hide();
   }
   else
   {
        $('#stamp_filed').hide();
        $('#points_filed').show();
        
   }
    
});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$(document).ready(function(){

$(".expiration_date").datepicker()
   // .on('changeDate', function (selected) {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
       // var maxDate = new Date(selected.date.valueOf());
        $('.expiration_date').datepicker('setStartDate', today);
  //  });

});
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
          var itemHtml = '<div class="row itemClass" id="item_<?php echo 1 + 1; ?>"><div class="col-md-3"><div class="form-group"><label for="nfc_code">NFC Code:</label>{!! Form::text('nfc_code[]', null, ['class' => 'form-control']) !!}</div></div><div class="col-md-2" style="margin-top: 20px;"><div class="input-group-btn"><button class="btn btn-danger remove_item" data-item-id="item_<?php echo 1 + 1; ?>" type="button"><i class="fa fa-minus"></i> </button><button class="btn btn-success add_item" data-item-id="item_<?php echo 1 + 1; ?>" type="button" style="margin-left: 2%;"><i class="fa fa-plus"></i></button></div></div></div><div class="clear"></div>';  
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
</script>
@endpush
