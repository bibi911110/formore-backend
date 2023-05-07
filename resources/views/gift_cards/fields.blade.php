<!-- To Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_name', 'To Name:') !!}
    {!! Form::text('to_name', null, ['class' => 'form-control']) !!}
</div>

<!-- To Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_email', 'To Email:') !!}
    {!! Form::text('to_email', null, ['class' => 'form-control']) !!}
</div>

<!-- From Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_name', 'From Name:') !!}
    {!! Form::text('from_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::text('message', null, ['class' => 'form-control']) !!}
</div>

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

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('giftCards.index') }}" class="btn btn-default">Cancel</a>
</div>
