
<div class="form-group">
    {!! Form::label('status', 'Select Status:') !!}
    {!! Form::select('status', [''=>'Select Status','Open' => 'Open',"On Process" => 'On Process',"Confirmed" => 'Confirmed','Not Valid' => 'Not Valid'], null, ['class' => 'form-control','id' => 'schema']) !!}
</div>
 <div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control','rows'=>'3']) !!}
</div>

<!-- Business Id Field -->
<!-- <div class="form-group">
    {!! Form::label('business_id', 'Business Id:') !!}
    {!! Form::text('business_id', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- User Id Field -->
<!-- <div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Voucher Id Field -->
<!-- <div class="form-group">
    {!! Form::label('voucher_id', 'Voucher Id:') !!}
    {!! Form::text('voucher_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Vat Number Field -->
<!-- <div class="form-group">
    {!! Form::label('vat_number', 'Vat Number:') !!}
    {!! Form::text('vat_number', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Date Of Purchase Field -->
<!-- <div class="form-group">
    {!! Form::label('date_of_purchase', 'Date Of Purchase:') !!}
    {!! Form::text('date_of_purchase', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Time Field -->
<!-- <div class="form-group">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Upload Receipt Field -->
<!-- <div class="form-group">
    {!! Form::label('upload_receipt', 'Upload Receipt:') !!}
    {!! Form::text('upload_receipt', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('voucherUploadReceipts.index') }}" class="btn btn-default">Cancel</a>
</div>
