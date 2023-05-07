@extends('layouts.app')
@section('title','Edit Refer Business')
@section('content')
<div class="content">
    
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Edit</strong> Refer Business</h2>
                </div>
                   {!! Form::model($referBusiness, ['route' => ['referBusinesses.update', $referBusiness->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('refer_businesses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection