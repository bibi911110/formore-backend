@extends('layouts.app')
@section('title','Create Notification')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Create New </strong> Notification</h2>
                </div>
                    {!! Form::open(['route' => 'notificationMasters.store', 'files' => true]) !!}

                        @include('notification_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
