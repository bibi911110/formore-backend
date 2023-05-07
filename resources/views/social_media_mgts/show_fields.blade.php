<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $socialMediaMgt->id }}</p>
</div>

<!-- Media Name Field -->
<div class="form-group">
    {!! Form::label('media_name', 'Media Name:') !!}
    <p>{{ $socialMediaMgt->media_name }}</p>
</div>

<!-- Media Category Field -->
<div class="form-group">
    {!! Form::label('media_category', 'Media Category:') !!}
    <p>{{ $socialMediaMgt->media_category }}</p>
</div>

<!-- Media Icon Field -->
<div class="form-group">
    {!! Form::label('media_icon', 'Media Icon:') !!}
    <p>{{ $socialMediaMgt->media_icon }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $socialMediaMgt->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $socialMediaMgt->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $socialMediaMgt->updated_at }}</p>
</div>

