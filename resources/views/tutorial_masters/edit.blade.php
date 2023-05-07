@extends('layouts.app')
@section('title','Create Tutorial Master')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Edit </strong> Tutorial</h2>
                </div>
                   {!! Form::model($tutorialMaster, ['route' => ['tutorialMasters.update', $tutorialMaster->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('tutorial_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection