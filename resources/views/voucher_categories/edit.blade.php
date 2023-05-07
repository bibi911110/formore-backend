@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Voucher Category
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($voucherCategory, ['route' => ['voucherCategories.update', $voucherCategory->id], 'method' => 'patch']) !!}

                        @include('voucher_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection