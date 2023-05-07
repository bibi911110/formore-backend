@extends('layouts.app')
@section('title','Booking Categories')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Create New </strong> Booking Categories</h2>
                </div>
                    {!! Form::open(['route' => 'bookingCategories.store']) !!}

                        @include('booking_categories.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
