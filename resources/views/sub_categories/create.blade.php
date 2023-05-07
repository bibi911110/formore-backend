@extends('layouts.app')
@section('title','Sub Category')
@section('content')

<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Sub Category</h2>
            </div>
                    {!! Form::open(['route' => 'subCategories.store','files' => true]) !!}

                        @include('sub_categories.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
