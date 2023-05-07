@extends('layouts.app')
@section('title','Edit Vehicle')
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
                   {!! Form::model($vehicle, ['route' => ['vehicles.update', $vehicle->id], 'method' => 'patch']) !!}

                        @include('vehicles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection