@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            User Voucher
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'userVouchers.store']) !!}

                        @include('user_vouchers.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
