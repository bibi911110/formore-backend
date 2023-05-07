@extends('layouts.app')
@section('title','Transaction Types')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Edit </strong> Transaction Types</h2>
            </div>
                   {!! Form::model($giftVocherTypes, ['route' => ['giftVocherTypes.update', $giftVocherTypes->id], 'method' => 'patch']) !!}

                        @include('gift_vocher_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection