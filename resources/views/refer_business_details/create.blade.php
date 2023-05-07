@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Refer Business Details
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'referBusinessDetails.store']) !!}

                        @include('refer_business_details.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
