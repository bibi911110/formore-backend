<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $extraServices->id }}</p>
</div>

<!-- Services Name Field -->
<div class="form-group">
    {!! Form::label('services_name', 'Services Name:') !!}
    <p>{{ $extraServices->services_name }}</p>
</div>

<!-- Services Per Price Field -->
<div class="form-group">
    {!! Form::label('services_per_price', 'Services Per Price:') !!}
    <p>{{ $extraServices->services_per_price }}</p>
</div>

<!-- Services Per Point Field -->
<div class="form-group">
    {!! Form::label('services_per_point', 'Services Per Point:') !!}
    <p>{{ $extraServices->services_per_point }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $extraServices->status }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $extraServices->created_by }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $extraServices->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $extraServices->updated_at }}</p>
</div>

