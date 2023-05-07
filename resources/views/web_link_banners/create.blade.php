@extends('layouts.app')
@section('title','Web Link Banners')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Web Link Banners</h2>
            </div>
                    {!! Form::open(['route' => 'webLinkBanners.store','files' => true]) !!}

                        @include('web_link_banners.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
