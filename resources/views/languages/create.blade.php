@extends('layouts.app')
@section('title','Create Language')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Create New </strong> Language</h2>
                </div>
               
                    {!! Form::open(['route' => 'languages.store', 'files' => true]) !!}

                        @include('languages.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
