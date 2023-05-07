@extends('layouts.app')
@section('title',' Member Orders')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong>  Member Orders</h2>
            </div>
                   {!! Form::model($memberOrders, ['route' => ['memberOrders.update', $memberOrders->id], 'method' => 'patch']) !!}

                        @include('member_orders.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection