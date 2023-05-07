@extends('layouts.app')
@section('title','Edit Language')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Language</h2>
                </div>
                   {!! Form::model($language, ['route' => ['languages.update', $language->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('languages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection