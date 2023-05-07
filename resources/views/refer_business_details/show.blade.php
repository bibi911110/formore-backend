@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Refer Business Details
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('refer_business_details.show_fields')
                    <a href="{{ route('referBusinessDetails.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
