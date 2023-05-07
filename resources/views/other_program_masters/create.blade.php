@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Other Program Master
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'otherProgramMasters.store', 'files' => true]) !!}

                        @include('other_program_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
