@extends('layouts.auth')

@section('content')
<h1>Login</h1>
<p class="account-subtitle">Masukan Akun Mu</p>
@if (session('login_error'))
<x-alerts.danger :error="session('login_error')" />
@endif
<!-- Form -->
<form action="{{route('login')}}" method="post">
	@csrf
	<div class="form-group">
		<input class="form-control" name="email" type="text" placeholder="Email">
	</div>
	<div class="form-group">
		<input class="form-control" name="password" type="password" placeholder="Password">
	</div>
	<div class="form-group">
		<button class="btn btn-primary btn-block" type="submit">Login</button>
	</div>
	{{-- <div class="form-group">
		<button class="btn btn-primary btn-block" type="submit">Login Google</button>
	</div> --}}
	{{-- <a href="{{ url('auth/google') }}">
 	 <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"/>
	</a> --}}

</form>
<!-- /Form -->

{{-- <div class="text-center forgotpass"><a href="{{route('forgot-password')}}">Forgot Password?</a></div> --}}

{{-- <div class="text-center dont-have">Belum punya akun? <a href="{{route('register')}}">Register</a></div> --}}
@endsection

