@extends('fronted.layouts.app')
@section('title','Home')

@section('content')
	
	<div>
		<span class="display1"></span>Home Page	
	</div>

	<div class="pull-right">	
	    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
	        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	        Sign out
	    </a>
	    
	    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
	        @csrf
	    </form>
	</div>

@endsection