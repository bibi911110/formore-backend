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
               <h2><strong>Create New </strong> Offer Banner</h2>
            </div>
                {!! Form::open(['route' => 'offerBanners.store','files' => true]) !!}

                        @include('offer_banners.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
