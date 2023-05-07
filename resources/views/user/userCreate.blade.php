@extends('layouts.app')

@section('title','User Create')

@section('content')

     <div class="content">

        @include('adminlte-templates::common.errors')

        <div class="box box-primary">

           <!-- Normal Form Block -->

            <div class="block">

                <!-- Normal Form Title -->

                <div class="block-title">
                    <h2><strong>Create New </strong> User</h2>

                </div>

             {!! Form::open(array('url' => 'buss_user_create','method'=>'POST')) !!}

                 <div class="form-group">
                        {!! Form::label('business_id', 'Business Name:') !!}
                        {!! Form::select('business_id', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
                    </div>
                     <div class="form-group">

                        <label for="example-nf-name">Name</label>

                        <input type="text" id="example-nf-name" name="name" class="form-control" placeholder="Enter Name..">

                        <!-- <span class="help-block">Please enter your name</span> -->

                    </div>

                    <div class="form-group">

                        <label for="example-nf-email">Email</label>

                        <input type="email" id="example-nf-email" name="email" class="form-control" placeholder="Enter email..">

                        <!-- <span class="help-block">Please enter your email</span> -->

                    </div>

                    <div class="form-group">

                        <label for="example-nf-password">Password</label>

                        <input type="password" id="example-nf-password" name="password" class="form-control" placeholder="Enter Password..">

                       <!--  <span class="help-block">Please enter your password</span> -->

                    </div>



                    <div class="form-group">

                        <label for="example-nf-password">Confirm Password</label>

                        <input type="password" id="example-nf-c_password" name="confirm-password" class="form-control" placeholder="Enter Password..">

                       <!--  <span class="help-block">Please enter your confirm password</span> -->

                    </div>



                    <!-- <div class="form-group">

                        <label for="example-nf-password">Role</label>

                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}

                        <span class="help-block">Please enter your confirm password</span>

                    </div> -->



                   <input class="mdc-radio__native-control" type="hidden" id="radio-1" name="is_admin" value="1" checked>

                
                <div class="form-group">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <!-- <a href="{{ route('vouchers.index') }}" class="btn btn-default">Cancel</a> -->
                </div>
                               

            {!! Form::close() !!}

            <!-- END Normal Form Content -->

            </div>

            <!-- END Normal Form Block -->

        </div>

    </div>

@endsection

