@extends('layouts.app')
@section('title'.' Social Icon')
@section('content')
    <section class="content-header">
        <h1>
            Social Icon
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($socialIcon, ['route' => ['socialIcons.update', $socialIcon->id], 'method' => 'patch']) !!}

                        @include('social_icons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection