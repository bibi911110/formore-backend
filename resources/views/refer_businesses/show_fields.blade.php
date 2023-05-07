<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $referBusiness->id }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $referBusiness->title }}</p>
</div>

<!-- Refer Icon Field -->
<div class="form-group">
    {!! Form::label('refer_icon', 'Refer Icon:') !!}
    <p>{{ $referBusiness->refer_icon }}</p>
</div>

<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('refer_text', 'Refer Text:') !!}
    <p>{{ $referBusiness->refer_text }}</p>
</div>

<!-- Term Details Field -->
<div class="form-group">
    {!! Form::label('term_details', 'Term Details:') !!}
    <p>{{ $referBusiness->term_details }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $referBusiness->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $referBusiness->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $referBusiness->updated_at }}</p>
</div>

