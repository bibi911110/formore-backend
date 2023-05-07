@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Slot Master
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('slot_masters.show_fields')
                    <a href="{{ route('slotMasters.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
