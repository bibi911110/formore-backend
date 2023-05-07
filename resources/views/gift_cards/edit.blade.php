@extends('layouts.app')
@section('title')
@section('content')
    <section class="content-header">
        <h1>
            Gift Card
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($giftCard, ['route' => ['giftCards.update', $giftCard->id], 'method' => 'patch']) !!}

                        @include('gift_cards.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection