@extends('layouts.app')
@section('title','Create Segment')
@section('content')
<div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <!-- <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
                    </div> -->
                    <h2><strong>Create New </strong> Segment</h2>
                </div>
                    {!! Form::open(['route' => 'segments.store']) !!}

                        @include('segments.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
