@extends('layouts.app')
@section('title','Services Product')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Services Product</h2>
            </div>
            {!! Form::open(['route' => 'servicesProducts.store', 'files' => true]) !!}

                        @include('services_products.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
