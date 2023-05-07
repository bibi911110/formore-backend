@extends('layouts.app')
@section('title','Create Country')
@section('content')
<div class="content">
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Create New </strong> Country</h2>
                </div>
                    {!! Form::open(['route' => 'countries.store','files' => true]) !!}

                        @include('countries.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
