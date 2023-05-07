<!-- Voucher Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('voucher_id', 'Voucher Id:') !!}
    {!! Form::text('voucher_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Credit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_credit', 'User Credit:') !!}
    {!! Form::text('user_credit', null, ['class' => 'form-control']) !!}
</div>

<!-- Stamps Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stamps', 'Stamps:') !!}
    {!! Form::text('stamps', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group col-sm-6">
    {!! Form::label('points', 'Points:') !!}
    {!! Form::text('points', null, ['class' => 'form-control']) !!}
</div>

<!-- Used Code Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('used_code_status', 'Used Code Status:') !!}
    {!! Form::text('used_code_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('userVouchers.index') }}" class="btn btn-default">Cancel</a>
</div>
