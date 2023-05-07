@extends('layouts.app')
@section('title','Edit Country')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Country</h2>
                </div>
                   {!! Form::model($country, ['route' => ['countries.update', $country->id], 'method' => 'patch','files' => true]) !!}

                        @include('countries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection