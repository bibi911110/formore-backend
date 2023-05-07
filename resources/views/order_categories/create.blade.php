@extends('layouts.app')
@section('title','Order Categories')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong>Order Categories</h2>
            </div>
                    {!! Form::open(['route' => 'orderCategories.store']) !!}

                        @include('order_categories.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
