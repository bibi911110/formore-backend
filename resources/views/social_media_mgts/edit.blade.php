@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Social Media Mgt
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($socialMediaMgt, ['route' => ['socialMediaMgts.update', $socialMediaMgt->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('social_media_mgts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection