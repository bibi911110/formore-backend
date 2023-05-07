@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Notification Details
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($notificationDetails, ['route' => ['notificationDetails.update', $notificationDetails->id], 'method' => 'patch']) !!}

                        @include('notification_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection