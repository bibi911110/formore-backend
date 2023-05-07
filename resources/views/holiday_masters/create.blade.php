@extends('layouts.app')
@section('title','Holiday Master')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Create New </strong>Holiday Master</h2>
                </div>
                    {!! Form::open(['route' => 'holidayMasters.store']) !!}

                        @include('holiday_masters.fields')

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
})

$(".input-datepickerStart").datepicker()
    .on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('.input-datepicker22').datepicker('setEndDate', maxDate);
    });

});
</script>
@endpush
