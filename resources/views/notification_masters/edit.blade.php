
@extends('layouts.app')
@section('title','Edit Notification')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Notification</h2>
                </div>
                   {!! Form::model($notificationMaster, ['route' => ['notificationMasters.update', $notificationMaster->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('notification_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection