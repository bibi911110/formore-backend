@extends('layouts.app')
@section('title','Find A Member')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>@if($business_details->stamp_point == 1 ) Stamp @else Point @endif </strong> </h2>
                </div>                
                    {!! Form::open(['route' => 'rewards_submit', 'files' => true]) !!}
                    
                    <input type="hidden" name="user_id" value="{{$user_details->id}}">
                        <!-- Language Name Field -->
                        
                        <div class="row">
                            <div class="form-group">
                                {!! Form::label('user_id', 'User Name:') !!}
                                {!! Form::label('user_id', $user_details->name) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('user_id', 'User Code:') !!}
                                {!! Form::label('user_id', $user_details->unique_no) !!}
                            </div>
                            @if($business_details->stamp_point == 1)
                            <input type="hidden" name="stamp_point" value="1">
                            <div class="form-group">
                                <h3>Rewards</h3>
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Stamp:') !!}
                                <label><?php echo $user_details->stamp .'/'. $business_stamp->setup_level; ?></label>
                            </div>
                            <div class="form-group">
                                <?php $pointCal = ($user_details->stamp * $business_stamp->stapm_point); ?>
                                {!! Form::label('user_id', 'Points:') !!}
                                <label><?php echo $pointCal; ?></label>
                            </div>
                            <input type="hidden" name="points" value="{{$pointCal}}">
                            @else
                                <div class="form-group">
                                    <h3>Rewards</h3>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('user_id', 'Current Point:') !!}
                                    <label>{{$user_details->point}}</label>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', 'Amount:') !!}
                                    {!! Form::text('amount', null, ['class' => 'form-control' ,'id'=>'amount']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', 'New Points:') !!}
                                    <label><p id="pointTxt"></p></label>
                                </div>
                                <input type="hidden" class="new_point" name="points" id="point_value" value="">
                                <input type="hidden" name="cash_out_ration" id="cash_out_ration" value="{{$business_point->ratio_for_cash_out}}">
                            @endif

                        </div>
                        
                        
                        <!-- Submit Field -->
                        <div class="form-group">
                            {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
                            <!-- <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a> -->
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
$("#amount").focusout(function() {
    var amount = $("#amount").val();
    var cash_out_ration = $("#cash_out_ration").val();

    var newPoint = parseInt(amount) * parseInt(cash_out_ration);
    //alert(newPoint);
    
    $("#point_value").val(newPoint);
    $("#pointTxt").text(newPoint);
    //alert(cash_out_ration);


});
</script>
@endpush