<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $nfcMaster->id }}</p>
</div>

<!-- Nfc Code Field -->
<div class="form-group">
    {!! Form::label('nfc_code', 'Nfc Code:') !!}
    <p>{{ $nfcMaster->nfc_code }}</p>
</div>

<!-- Nfc Url Field -->
<div class="form-group">
    {!! Form::label('nfc_url', 'Nfc Url:') !!}
    <p>{{ $nfcMaster->nfc_url }}</p>
</div>

<!-- Linked Url Field -->
<div class="form-group">
    {!! Form::label('linked_url', 'Linked Url:') !!}
    <p>{{ $nfcMaster->linked_url }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $nfcMaster->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $nfcMaster->updated_at }}</p>
</div>

