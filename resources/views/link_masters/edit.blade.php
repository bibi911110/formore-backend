

@extends('layouts.app')
@section('title','Edit Link')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Link</h2>
                </div>
                   {!! Form::model($linkMaster, ['route' => ['linkMasters.update', $linkMaster->id], 'method' => 'patch']) !!}

                        @include('link_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection