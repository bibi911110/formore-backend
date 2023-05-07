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
                   {!! Form::model($userVoucher, ['route' => ['userVouchers.update', $userVoucher->id], 'method' => 'patch']) !!}

                        @include('user_vouchers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection