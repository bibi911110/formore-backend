@extends('layouts.app')
@section('title','User Show')
@section('content')
    <section class="content-header">
        <h1>
            Show Users
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">

                    <div class="form-group">
                        {!! Form::label('id', 'Id:') !!}
                        <p>{{ $user->id }}</p>
                    </div>


                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        <p>{{ $user->name }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('role', 'Role:') !!}
                        <p>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="label label-success" style="padding: 5px 12px;">{{ $v }}</label>
                                @endforeach
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        {!! Form::label('created_at', 'Created At:') !!}
                        <p>{{ $user->created_at }}</p>
                    </div>


                    <div class="form-group">
                        {!! Form::label('updated_at', 'Updated At:') !!}
                        <p>{{ $user->updated_at }}</p>
                    </div>

                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('users.index') }}" class="btn btn-default pull-left">Back</a>
            </div>
        </div>
    </div>
@endsection
