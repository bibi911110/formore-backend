<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $loyaltyBannerMaster->id }}</p>
</div>

<!-- Terms Of Loyalty Field -->
<div class="form-group">
    {!! Form::label('terms_of_loyalty', 'Terms Of Loyalty:') !!}
    <p>{{ $loyaltyBannerMaster->terms_of_loyalty }}</p>
</div>

<!-- Schema Field -->
<div class="form-group">
    {!! Form::label('schema', 'Schema:') !!}
    <p>{{ $loyaltyBannerMaster->schema }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $loyaltyBannerMaster->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $loyaltyBannerMaster->updated_at }}</p>
</div>

