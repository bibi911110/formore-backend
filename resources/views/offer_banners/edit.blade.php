@extends('layouts.app')
@section('title','Offer Banner')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong> Offer Banner</h2>
            </div>
                
                   {!! Form::model($offerBanner, ['route' => ['offerBanners.update', $offerBanner->id], 'method' => 'patch','files' => true]) !!}

                        @include('offer_banners.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection