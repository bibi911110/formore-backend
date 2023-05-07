<!DOCTYPE html>
<html>
<head>
	<title>Login | {{ config('app.name') }}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('public/backend/css/login.css')}}" rel="stylesheet">
</head>
<body>

    <div class="card card0 border-0">
        <div class="row d-flex" style="margin: 29px 0 30px 0;">

            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                </div>
            </div>

            <div class="col-lg-6" style="padding-top: 120px;">

            	@if(session()->has('message'))
				    <div class="alert alert-success">
				        <i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ session()->get('message') }}
				    </div>
				@endif

                <div class="card2 card border-0 px-4 py-5">
                	<form method="post" action="{{ url('/login') }}">
                		@csrf

	                    <div class="row px-3"> 
	                    	<label class="mb-1">
	                            <span class="mb-0 text-sm">
	                            	Email Address
	                            </span>
	                        </label>

	                        <input type="text" name="email" placeholder="Enter a valid email address" name="email" value="{{ old('email') }}"> 

	                        @if ($errors->has('email'))
			                    <span class="text-sm text-danger">{{ $errors->first('email') }}</span>
			                @endif
	                    </div>

	                    <div class="row px-3 mt-5"> 
	                    	<label class="mb-1">
	                            <h6 class="mb-0 text-sm">
	                            	Password
	                            </h6>
	                        </label> 
	                        <input type="password" name="password" placeholder="Enter password" name="password">
	                        @if ($errors->has('password'))
			                    <span class="text-sm text-danger">{{ $errors->first('password') }}</span>
			                @endif
	                    </div>
	                    
	                    <div class="row px-3 mb-4"></div>
	                    
	                    <div class="row mb-3 px-3"> 
	                    	<button type="submit" class="btn btn-blue text-center">Login</button> 
	                    </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="bg-blue py-4">
            <div class="row px-3"> 
            	<small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2020. All rights reserved.</small>
                <div class="social-contact ml-4 ml-sm-auto"> 
                	<span class="fa fa-facebook mr-4 text-sm"></span> 
                	<span class="fa fa-google-plus mr-4 text-sm"></span> 
                	<span class="fa fa-linkedin mr-4 text-sm"></span> 
                	<span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> 
                </div>
            </div>
        </div>
    </div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>