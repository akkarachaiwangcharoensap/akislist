<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/auth/login.css') }}">
</head>

<body>
	@include('templates.navigation')
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 login section">
				<h1>Login <small>Don't have an account? <a href="{{ route('register') }}">Sign up now!</a></small></h1>
				<form class="form-group" method="POST" action="{{ route('login') }}">
					
					@csrf
					
					<div class="form-section">
						<label>
							Email
							@if ($errors->first('email') != null)
								<span class="error">({{ $errors->first('email') }})</span>
							@endif
						</label>
						<input type="email" name="email" class="form-control" placeholder="youraddress@example.com" required>
					</div><!-- .form-section -->

					<div class="form-section">
						<label>
							Password 
						</label>
						<input type="password" name="password" class="form-control" placeholder="password" required>	
					</div><!-- .form-section -->

					<input type="submit" class="button blue float-right mt-4" name="loginSubmit" value="Login">
				</form><!-- .form-group -->
			</div><!-- .contact.section -->
		</div><!-- .row -->
	</div><!-- .container -->

	@include('templates.footer')
</body>