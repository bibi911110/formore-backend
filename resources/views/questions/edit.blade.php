@extends('layouts.app')
@section('title','Question')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong> Edit </strong> Question</h2>
            </div>
                   {!! Form::model($question, ['route' => ['questions.update', $question->id], 'method' => 'patch','files' => true]) !!}

                        @include('questions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection