<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $userVoucher->id }}</p>
</div>

<!-- Voucher Id Field -->
<div class="form-group">
    {!! Form::label('voucher_id', 'Voucher Id:') !!}
    <p>{{ $userVoucher->voucher_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userVoucher->user_id }}</p>
</div>

<!-- User Credit Field -->
<div class="form-group">
    {!! Form::label('user_credit', 'User Credit:') !!}
    <p>{{ $userVoucher->user_credit }}</p>
</div>

<!-- Stamps Field -->
<div class="form-group">
    {!! Form::label('stamps', 'Stamps:') !!}
    <p>{{ $userVoucher->stamps }}</p>
</div>

<!-- Points Field -->
<div class="form-group">
    {!! Form::label('points', 'Points:') !!}
    <p>{{ $userVoucher->points }}</p>
</div>

<!-- Used Code Status Field -->
<div class="form-group">
    {!! Form::label('used_code_status', 'Used Code Status:') !!}
    <p>{{ $userVoucher->used_code_status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userVoucher->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userVoucher->updated_at }}</p>
</div>

