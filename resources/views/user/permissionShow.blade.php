@extends('layouts.app')
@section('title','Permission Show')
@section('content')
    <section class="content-header">
        <h1>
            Permission
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">

                    <div class="form-group">
                        {!! Form::label('id', 'Id:') !!}
                        <p>{{ $permission->id }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        <p>{{ $permission->name }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('guard name', 'Guard name:') !!}
                        <p>{{ $permission->guard_name }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('created_at', 'Created At:') !!}
                        <p>{{ $permission->created_at }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('updated_at', 'Updated At:') !!}
                        <p>{{ $permission->updated_at }}</p>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('permissions.index') }}" class="btn btn-default pull-left">Back</a>
            </div>
        </div>
    </div>
@endsection
