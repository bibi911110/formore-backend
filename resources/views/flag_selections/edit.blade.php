@extends('layouts.app')
@section('title',' Flag Selection')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong>  Flag Selection</h2>
            </div>
                   {!! Form::model($flagSelection, ['route' => ['flagSelections.update', $flagSelection->id], 'method' => 'patch']) !!}

                        @include('flag_selections.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection