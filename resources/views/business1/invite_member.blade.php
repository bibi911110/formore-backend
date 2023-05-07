@extends('layouts.app')
@section('title','Find A Member')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Send </strong>Invitation </h2>
                </div>
               
                    {!! Form::open(['route' => 'sendInvitation', 'files' => true]) !!}

                        <!-- Language Name Field -->
                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <!-- Status Field -->
                        <!-- <div class="form-group">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::text('status', null, ['class' => 'form-control']) !!}
                        </div>
                        -->
                        <!-- Submit Field -->
                        <div class="form-group">
                            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                            <!-- <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a> -->
                        </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
