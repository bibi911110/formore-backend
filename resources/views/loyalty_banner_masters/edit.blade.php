@extends('layouts.app')
@section('title','Loyalty Banner Master')
@section('content')
<div class="content">
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit </strong> Loyalty Banner Master</h2>
                </div>
                   {!! Form::model($loyaltyBannerMaster, ['route' => ['loyaltyBannerMasters.update', $loyaltyBannerMaster->id], 'method' => 'patch','files' => true]) !!}

                        @include('loyalty_banner_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection