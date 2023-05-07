@extends('layouts.app')
@section('title','Slot Master')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Slot Master</h2>
            </div>
                   {!! Form::model($slotMaster, ['route' => ['slotMasters.update', $slotMaster->id], 'method' => 'patch']) !!}

                        @include('slot_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection