<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $linkMaster->id }}</p>
</div>

<!-- Term Link Field -->
<div class="form-group">
    {!! Form::label('term_link', 'Term Link:') !!}
    <p>{{ $linkMaster->term_link }}</p>
</div>

<!-- Privacy Link Field -->
<div class="form-group">
    {!! Form::label('privacy_link', 'Privacy Link:') !!}
    <p>{{ $linkMaster->privacy_link }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $linkMaster->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $linkMaster->updated_at }}</p>
</div>

