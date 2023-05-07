@extends('layouts.app')
@section('title','Role Show')
@section('content')
    <section class="content-header">
        <h1>
            Roles
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">

                    <div class="form-group">
                        {!! Form::label('id', 'Id:') !!}
                        <p>{{ $role->id }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        <p>{{ $role->name }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('permissions', 'Permissions:') !!}<br>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <p style="display: inline-block;">
                                    <label class="label label-success" style="padding: 5px 12px;">
                                        {{ $v->name }}
                                    </label>
                                </p>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('created_at', 'Created At:') !!}
                        <p>{{ $role->created_at }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('updated_at', 'Updated At:') !!}
                        <p>{{ $role->updated_at }}</p>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('roles.index') }}" class="btn btn-default pull-left">Back</a>
            </div>
        </div>
    </div>
@endsection
