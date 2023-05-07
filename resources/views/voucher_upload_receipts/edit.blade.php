@extends('layouts.app')
@section('title','Voucher Upload Receipt')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Voucher Upload Receipt</h2>
                </div>
                   {!! Form::model($voucherUploadReceipt, ['route' => ['voucherUploadReceipts.update', $voucherUploadReceipt->id], 'method' => 'patch']) !!}

                        @include('voucher_upload_receipts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection