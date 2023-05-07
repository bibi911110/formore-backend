@extends('layouts.app')
@section('title','Show Segment')
@section('content')
    <section class="content-header">
        <h1>
            Segment
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('segments.show_fields')
                    <a href="{{ route('segments.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
