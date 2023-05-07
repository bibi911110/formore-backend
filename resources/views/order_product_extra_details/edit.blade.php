@extends('layouts.app')
@section('title','Order Product Extra Details')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong> Order Product Extra Details</h2>
            </div>
                   {!! Form::model($orderProductExtraDetails, ['route' => ['orderProductExtraDetails.update', $orderProductExtraDetails->id], 'method' => 'patch']) !!}

                        @include('order_product_extra_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection