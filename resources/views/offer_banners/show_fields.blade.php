<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $offerBanner->id }}</p>
</div>

<!-- Offer Image Field -->
<div class="form-group">
    {!! Form::label('offer_image', 'Offer Image:') !!}
    <p>{{ $offerBanner->offer_image }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $offerBanner->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $offerBanner->updated_at }}</p>
</div>

