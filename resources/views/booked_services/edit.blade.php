@extends('layouts.app')
@section('title','Booked Services')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong> Booked Services</h2>
            </div>
                   {!! Form::model($bookedServices, ['route' => ['bookedServices.update', $bookedServices->id], 'method' => 'patch']) !!}

                        @include('booked_services.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection