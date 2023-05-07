@extends('layouts.app')
@section('title','Purchase Options')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Purchase Options</h2>
            </div>
                {!! Form::open(['route' => 'purchaseOptions.store','files' => true]) !!}

                        @include('purchase_options.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
