@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Week Off Master
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('week_off_masters.show_fields')
                    <a href="{{ route('weekOffMasters.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
