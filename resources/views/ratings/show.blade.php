@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Rating
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('ratings.show_fields')
                    <a href="{{ route('ratings.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
