@extends('layouts.app')
@section('title','Gallery')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong>Gallery</h2>
            </div>
                
                   {!! Form::model($galleryMaster, ['route' => ['galleryMasters.update', $galleryMaster->id], 'method' => 'patch','files' => true]) !!}

                        @include('gallery_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection