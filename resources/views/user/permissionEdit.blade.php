@extends('layouts.app')
@section('title','Role Edit')
@section('content')
    <section class="content-header">
        <h1>
            Permissions
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
          {!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <strong>Name:</strong>
                          <input type="text" class="form-control" name="name" value="{{$permission->name}}" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <strong>Guard Name:</strong>
                        <input type="text" class="form-control" name="guard_name" value="{{$permission->guard_name}}" readonly>
                    </div>
                  </div>
                </div>
            </div>
            <div class="box-footer">
              <div class="form-group col-sm-12">
                  <a href="{{ route('permissions.index') }}" class="btn btn-default pull-left">Cancel</a>
                  {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
              </div>
            </div>
          {!! Form::close() !!}
       </div>
   </div>
@endsection