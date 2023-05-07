<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $giftCard->id }}</p>
</div>

<!-- To Name Field -->
<div class="form-group">
    {!! Form::label('to_name', 'To Name:') !!}
    <p>{{ $giftCard->to_name }}</p>
</div>

<!-- To Email Field -->
<div class="form-group">
    {!! Form::label('to_email', 'To Email:') !!}
    <p>{{ $giftCard->to_email }}</p>
</div>

<!-- From Name Field -->
<div class="form-group">
    {!! Form::label('from_name', 'From Name:') !!}
    <p>{{ $giftCard->from_name }}</p>
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $giftCard->message }}</p>
</div>

<!-- Voucher Id Field -->
<div class="form-group">
    {!! Form::label('voucher_id', 'Voucher Id:') !!}
    <p>{{ $giftCard->voucher_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $giftCard->user_id }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $giftCard->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $giftCard->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $giftCard->updated_at }}</p>
</div>

