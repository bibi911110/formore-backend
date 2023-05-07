<!-- Nfc Code Field -->
<div class="form-group">
    {!! Form::label('nfc_code', 'NFC Code:') !!}
    {!! Form::text('nfc_code', null, ['class' => 'form-control']) !!}
</div>


<!-- Nfc Url Field -->
<div class="form-group">
    {!! Form::label('nfc_url', 'www.formore.eu/nfc/:') !!}
    {!! Form::text('nfc_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Linked Url Field -->
<div class="form-group">
    {!! Form::label('linked_url', 'Linked Url:') !!}
    {!! Form::text('linked_url', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('buss_id', 'Business :') !!}
    {!! Form::select('buss_id', [''=>'Select Business'] + $buss->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
</div>
<div class="form-group">
    {!! Form::label('linked_url', 'Notes:') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('nfcMasters.index') }}" class="btn btn-default">Cancel</a>
</div>
