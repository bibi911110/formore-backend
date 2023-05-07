<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $appScreenInformation->id }}</p>
</div>

<!-- Screen Name Field -->
<div class="form-group">
    {!! Form::label('screen_name', 'Screen Name:') !!}
    <p>{{ $appScreenInformation->screen_name }}</p>
</div>

<!-- Language Id Field -->
<div class="form-group">
    {!! Form::label('language_id', 'Language Id:') !!}
    <p>{{ $appScreenInformation->language_id }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $appScreenInformation->content }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $appScreenInformation->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $appScreenInformation->updated_at }}</p>
</div>

