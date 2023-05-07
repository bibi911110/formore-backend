@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Promotional Image Master
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'promotionalImageMasters.store', 'files' => true]) !!}

                        @include('promotional_image_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
