@extends('layouts.app')
@section('title','User Edit')
@section('content')
 <div class="block">
    <!-- Normal Form Title -->
    <div class="block-title">
        <h2><strong>Edit</strong> User</h2>
    </div>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
           
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
           
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
           
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                </div>
                        
                   </div>
                </div>
                <div class="form-group form-actions">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Submit</button>
                </div>
                <!-- <div class="box-footer">
                  <div class="form-group col-sm-12">
                      <a href="{{ route('users.index') }}" class="btn btn-default pull-left">Cancel</a>
                      {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                  </div>
                </div> -->
            {!! Form::close() !!}
       </div>
@endsection