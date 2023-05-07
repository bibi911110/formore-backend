@extends('layouts.app')
@section('title','Create Vehicle')
@section('content')
<div class="content">
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Create New </strong> Vehicle</h2>
                </div>
                    {!! Form::open(['route' => 'vehicles.store']) !!}

                        @include('vehicles.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
