@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Gift Card
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'giftCards.store']) !!}

                        @include('gift_cards.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
