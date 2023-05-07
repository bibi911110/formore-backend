@extends('layouts.app')
@section('title','Social Icon')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Social Icon</h2>
            </div>
                    {!! Form::open(['route' => 'socialIcons.store','files' => true]) !!}
                    @include('social_icons.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


