@extends('layouts.app')
@section('title','App Screen Information')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong> App Screen Information</h2>
            </div>
                   {!! Form::model($appScreenInformation, ['route' => ['appScreenInformations.update', $appScreenInformation->id], 'method' => 'patch']) !!}

                        @include('app_screen_informations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection