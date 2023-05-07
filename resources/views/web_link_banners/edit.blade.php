@extends('layouts.app')
@section('title','eb Link Banners')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit</strong> Web Link Banners</h2>
            </div>
               <div class="row">
                   {!! Form::model($webLinkBanners, ['route' => ['webLinkBanners.update', $webLinkBanners->id], 'method' => 'patch','files' => true]) !!}

                        @include('web_link_banners.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection