@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Tutorial Master
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('tutorial_masters.show_fields')
                    <a href="{{ route('tutorialMasters.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
