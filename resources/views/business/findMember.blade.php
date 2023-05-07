@extends('layouts.app')
@section('title','Find A Member')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Find A </strong> Member</h2>
                </div>
               
                    {!! Form::open(['route' => 'findMemberDetails', 'files' => true,'name'=>'FindMemberForm']) !!}

                        @include('business.findMemberfields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
