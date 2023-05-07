<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $galleryMaster->id }}</p>
</div>

<!-- Gallery Img Field -->
<div class="form-group">
    {!! Form::label('gallery_img', 'Gallery Img:') !!}
    <p>{{ $galleryMaster->gallery_img }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $galleryMaster->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $galleryMaster->updated_at }}</p>
</div>

