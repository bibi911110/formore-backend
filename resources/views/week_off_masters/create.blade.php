@extends('layouts.app')
@section('title',' Week Off Master')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New</strong> Week Off Master</h2>
            </div>
                    {!! Form::open(['route' => 'weekOffMasters.store']) !!}

                        @include('week_off_masters.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
