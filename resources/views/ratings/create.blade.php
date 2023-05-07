@extends('layouts.app')
@section('title','Rating')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Rating</h2>
            </div>
                    {!! Form::open(['route' => 'ratings.store']) !!}

                        @include('ratings.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
