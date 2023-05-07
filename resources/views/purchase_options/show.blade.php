@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Purchase Options
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('purchase_options.show_fields')
                    <a href="{{ route('purchaseOptions.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
