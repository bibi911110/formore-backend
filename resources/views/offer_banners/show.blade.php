@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Offer Banner
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('offer_banners.show_fields')
                    <a href="{{ route('offerBanners.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
