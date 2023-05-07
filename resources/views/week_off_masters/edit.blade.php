@extends('layouts.app')
@section('title',' Week Off Master')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit</strong> Week Off Master</h2>
            </div>
                   {!! Form::model($weekOffMaster, ['route' => ['weekOffMasters.update', $weekOffMaster->id], 'method' => 'patch']) !!}

                        @include('week_off_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection