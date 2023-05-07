<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $notificationDetails->id }}</p>
</div>

<!-- Notification Id Field -->
<div class="form-group">
    {!! Form::label('notification_id', 'Notification Id:') !!}
    <p>{{ $notificationDetails->notification_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $notificationDetails->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $notificationDetails->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $notificationDetails->updated_at }}</p>
</div>

