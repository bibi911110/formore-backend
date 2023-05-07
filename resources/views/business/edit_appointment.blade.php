@extends('layouts.app')
@section('title','Edit Book Appointment')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Edit Book </strong> Appointment</h2>
                </div>
                    @include('flash::message')
                    {!! Form::open(['url' => 'update_book_appointment', 'files' => true]) !!}
                    @csrf

                        <!-- Language Name Field -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('date', 'Date:') !!}
                                        <input type="hidden" name="booking_id" value="{{$appointmentDetails->id}}">
                                        {!! Form::text('start_date',date('Y-m-d',strtotime($appointmentDetails->booking_service_date_time)), ['class' => 'form-control','readonly'=>'true']) !!}
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('time', 'Time:') !!}
                                        {!! Form::text('time', $slot_details->slot_time , ['class' => 'form-control','readonly'=>'true']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('user_name', 'User Name:') !!}
                                        {!! Form::text('user_name', $user_details->name, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('user_id', 'User ID:') !!}
                                        {!! Form::text('user_id', $user_details->unique_no, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email:') !!}
                                        {!! Form::text('email', $user_details->email, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('service', 'Service:') !!}
                                        {!! Form::select('product_id[]', [''=>'Select Service'] + $services->toArray(), $appointmentDetails->service_name, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('telephone', 'Telephone:') !!}
                                        {!! Form::text('telephone', $user_details->mobile_no    , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Select Status:') !!}
    {!! Form::select('status', [''=>'Select Status','Open' => 'Open',"Confirm" => 'Confirm',"Reschedule" => 'Reschedule',"Cancel" =>'Cancel'], $appointmentDetails->status, ['class' => 'form-control','id' => 'campaign_type']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('comments', 'Comments:') !!}
                                        <textarea name="comments" class="form-control" id="comments"><?php echo $appointmentDetails->comments ?></textarea>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- Submit Field -->
                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ url('/appointments_view') }}" class="btn btn-default">Cancel</a>
                            </div>


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
    });
});
</script>
@endpush