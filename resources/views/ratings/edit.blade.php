@extends('layouts.app')
@section('title','Rating')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong> Rating</h2>
            </div>
                   {!! Form::model($rating, ['route' => ['ratings.update', $rating->id], 'method' => 'patch']) !!}

                        @include('ratings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection