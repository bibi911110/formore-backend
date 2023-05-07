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
               <h2><strong>Create New </strong> Transaction Types</h2>
            </div>

            {!! Form::open(['route' => 'giftVocherTypes.store']) !!}

                        @include('gift_vocher_types.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
