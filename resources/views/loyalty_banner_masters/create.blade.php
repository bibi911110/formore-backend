@extends('layouts.app')
@section('title','Loyalty Banner')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Loyalty Banner</h2>
            </div>
                {!! Form::open(['route' => 'loyaltyBannerMasters.store','files' => true]) !!}

                        @include('loyalty_banner_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
