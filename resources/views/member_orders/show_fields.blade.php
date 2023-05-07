<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $memberOrders->id }}</p>
</div>

<!-- Member Name Field -->
<div class="form-group">
    {!! Form::label('member_name', 'Member Name:') !!}
    <p>{{ $memberOrders->member_name }}</p>
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $memberOrders->member_id }}</p>
</div>

<!-- Order Details Field -->
<div class="form-group">
    {!! Form::label('order_details', 'Order Details:') !!}
    <p>{{ $memberOrders->order_details }}</p>
</div>

<!-- Delivery Address Field -->
<div class="form-group">
    {!! Form::label('delivery_address', 'Delivery Address:') !!}
    <p>{{ $memberOrders->delivery_address }}</p>
</div>

<!-- Member Comments Field -->
<div class="form-group">
    {!! Form::label('member_comments', 'Member Comments:') !!}
    <p>{{ $memberOrders->member_comments }}</p>
</div>

<!-- Advance Payment Field -->
<div class="form-group">
    {!! Form::label('advance_payment', 'Advance Payment:') !!}
    <p>{{ $memberOrders->advance_payment }}</p>
</div>

<!-- Points Field -->
<div class="form-group">
    {!! Form::label('points', 'Points:') !!}
    <p>{{ $memberOrders->points }}</p>
</div>

<!-- Cash Field -->
<div class="form-group">
    {!! Form::label('cash', 'Cash:') !!}
    <p>{{ $memberOrders->cash }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $memberOrders->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $memberOrders->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $memberOrders->updated_at }}</p>
</div>

