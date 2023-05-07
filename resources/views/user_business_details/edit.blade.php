@extends('layouts.app')
@section('title','User Business Details')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2>Business/Brand Details</h2>
            </div>
                     {!! Form::model($userBusinessDetails, ['route' => ['userBusinessDetails.update', $userBusinessDetails->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('user_business_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection