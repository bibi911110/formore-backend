@extends('layouts.app')
@section('title','Coupon Master Order')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit</strong> Coupon Master Order</h2>
            </div>
                   {!! Form::model($couponMasterServices, ['route' => ['couponMasterServices.update', $couponMasterServices->id], 'method' => 'patch']) !!}

                        @include('coupon_master_services.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@push('scripts')
<script type="text/javascript">

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

</script>
@endpush