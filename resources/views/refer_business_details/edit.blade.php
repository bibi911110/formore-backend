@extends('layouts.app')
@section('title','Refer Business Details')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit</strong>Refer Business Details</h2>
            </div>
               <div class="row">
                   {!! Form::model($referBusinessDetails, ['route' => ['referBusinessDetails.update', $referBusinessDetails->id], 'method' => 'patch']) !!}

                        @include('refer_business_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection