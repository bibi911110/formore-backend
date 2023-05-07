@extends('layouts.app')
@section('title','App Screen Information')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> App Screen Information</h2>
            </div>


                  {!! Form::open(['route' => 'appScreenInformations.store']) !!}

                        @include('app_screen_informations.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
