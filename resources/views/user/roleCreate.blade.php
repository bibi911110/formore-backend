@extends('layouts.app')
@section('title','Role Create')
@section('content')
<div class="block">
    <!-- Normal Form Title -->
    <div class="block-title">
        <h2><strong>Edit</strong> User</h2>
    </div>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
               
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
         <div class="form-group">
                  <strong>Permission:</strong>
                  <div class="row">
                    @foreach($permission as $value)
                      <div class="col-md-3">
                        <div class="mdc-touch-target-wrapper">
                          <div class="mdc-checkbox mdc-checkbox--touch">
                           {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'mdc-checkbox__native-control','id' => 'checkbox-'.$value->id)) }}

                              <!-- <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                  <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                </svg>
                                
                                <div class="mdc-checkbox__mixedmark"></div>
                              </div>
                              <div class="mdc-checkbox__ripple"></div> -->
                          </div>
                            <label for="checkbox-{{$value->id}}" style="margin-bottom: 15px !important;cursor: pointer;">{{ $value->name }}</label>
                        </div>
                      </div>
                    @endforeach
                <div class="box-footer">
                <div class="form-group col-sm-12">
                    <a href="{{ route('roles.index') }}" class="btn btn-default pull-left">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
@endsection
