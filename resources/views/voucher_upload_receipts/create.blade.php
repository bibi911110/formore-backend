@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Voucher Upload Receipt
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'voucherUploadReceipts.store']) !!}

                        @include('voucher_upload_receipts.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
