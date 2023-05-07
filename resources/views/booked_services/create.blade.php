@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Booked Services
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'bookedServices.store']) !!}

                        @include('booked_services.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
