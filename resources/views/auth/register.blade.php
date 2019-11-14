<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/auth/register.css') }}">
	
</head>

<body>
	@include('templates.navigation')

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 register section">
				<h1>Register</h1>
				<form class="form-group" method="POST" action="{{ route('register') }}">
					
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
							First Name
							@if ($errors->first('first_name') != null)
								<span class="error">({{ $errors->first('first_name') }})</span>
							@endif
						</label>
						<input type="text" name="first_name" class="form-control" placeholder="first name" required>	
					</div><!-- .form-section -->

					<div class="form-section">
						<label>
							Last Name
							@if ($errors->first('last_name') != null)
								<span class="error">({{ $errors->first('last_name') }})</span>
							@endif
						</label>
						<input type="text" name="last_name" class="form-control" placeholder="last name" required>
					</div><!-- .form-section -->

					<div class="form-section">
						<label>
							Password 
							@if ($errors->first('password') != null)
								<span class="error">({{ $errors->first('password') }})</span>
							@endif
						</label>
						<input type="password" name="password" class="form-control" placeholder="password" required>	
					</div><!-- .form-section -->
					
					<div class="form-section">
						<label>
							Confirm Password
						</label>
						<input type="password" name="password_confirmation" class="form-control" placeholder="confirm password" required>	
					</div><!-- .form-section -->

					<input type="submit" class="button green float-right mt-4" name="registerSubmit" value="Register">
				</form><!-- .form-group -->
			</div><!-- .contact.section -->
		</div><!-- .row -->
	</div><!-- .container -->

	@include('templates.footer')
</body>