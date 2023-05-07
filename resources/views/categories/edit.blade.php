@extends('layouts.app')
@section('title','Categories')
@section('content')
<div class="content">
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Create New </strong> Categories</h2>
                </div>
                   {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection