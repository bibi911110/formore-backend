@extends('layouts.app')
@section('title','Create Refer Business')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Create New </strong> Refer Business</h2>
                </div>
                    {!! Form::open(['route' => 'referBusinesses.store', 'files' => true]) !!}

                        @include('refer_businesses.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
