@extends('layouts.app')
@section('title','Role Create')
@section('content')
    <section class="content-header">
        <h1>
            Permissions
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Permission Name:</strong>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Guard Name:</strong>
                                <input type="text" class="form-control" name="guard_name" value="web" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group col-sm-12">
                        <a href="{{ route('permissions.index') }}" class="btn btn-default pull-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
