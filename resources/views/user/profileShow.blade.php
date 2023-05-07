@extends('layouts.app')
@section('title','Profile')
<style type="text/css">
    .user_img{
        height: 100px;
        width: 100px;
        margin-left: 40%;
    }
</style>
@section('content')


    <div class="content" style="width: 50%;">

        @if($errors->count())
            <div class="box-body">
                <div class="alert alert-danger col-md-12">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="box box-primary">
            <div class="box-body">
                <img src="{{ url('backend/images/user.png') }}" class="user_img">
                <div class="row">

                    <div class="col-md-12 form-group">
                        {!! Form::label('name', 'Name:') !!}
                        <input type="text" value="{{$user->name}}" class="form-control" readonly>
                    </div>

                    <div class="col-md-12 form-group">
                        {!! Form::label('email', 'Email:') !!}
                        <input type="text" value="{{$user->email}}" class="form-control" readonly>
                    </div>

                </div>
            </div>

            <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" id="CancleUpdateProfile">Cancle</button>
                <button type="button" class="btn btn-primary pull-right" id="UpdateProfile">Update</button>
            </div>
        </div>
    </div>

    <div class="content" id="UpdateProfileDiv" style="width: 50%;">
        <div class="box box-primary">
            <form method="post" action="{{ url('administrator/profile/update') }}">
                @csrf
                <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                {!! Form::label('name', 'Name:') !!}
                                
                                <input type="text" value="{{$user->name}}" name="name" class="form-control" >
                            </div>

                            <div class="col-md-12 form-group">
                                {!! Form::label('email', 'Email:') !!}
                                
                                <input type="text" value="{{$user->email}}" name="email" class="form-control">
                            </div>

                            <div class="col-md-12 form-group">
                                {!! Form::label('password', 'Password:') !!}
                                <input type="text" name="password" class="form-control">
                            </div>

                            <div class="col-md-12 form-group">
                                {!! Form::label('confirm password', 'Confirm Password:') !!}
                                <input type="text" name="confirm_pwd" class="form-control">

                                <input type="hidden" value="{{$user->password}}" name="old_pwd" class="form-control">

                                <input type="hidden" value="{{$user->id}}" name="id" class="form-control">
                            </div>                        
                        </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="UpdateProfile" style="margin-left: 40%;">Save login info.</button>
                </div>
            </form>
        </div>
    </div>
@endsection
    
@section('scripts')
    <script type="text/javascript">
        $("#UpdateProfileDiv").hide();
        
        $("#UpdateProfile").click(function(){
          $("#UpdateProfileDiv").show();
        }); 

        $("#CancleUpdateProfile").click(function(){
          $("#UpdateProfileDiv").hide();
        }); 
    </script>
@endsection