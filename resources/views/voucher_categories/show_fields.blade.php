<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $voucherCategory->id }}</p>
</div>

<!-- Voucher Category Field -->
<div class="form-group">
    {!! Form::label('voucher_category', 'Voucher Category:') !!}
    <p>{{ $voucherCategory->voucher_category }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $voucherCategory->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $voucherCategory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $voucherCategory->updated_at }}</p>
</div>

