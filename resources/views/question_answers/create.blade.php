@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Question Answer
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'questionAnswers.store']) !!}

                        @include('question_answers.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
