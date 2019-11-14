<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/confirmation.css') }}">

	<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 description section">
				<h1>Account Confirmation</h1>
				<p>
					We have sent an email to your email address. Please see the email and verify your account. In case where you did not receive the email. Please click the "Resend" button to resend the confirmation email.
				</p>
				<form method="POST" action="{{ route('profile.confirmation.resend') }}" class="resend-form">
					@csrf
					<input type="submit" name="resendSubmit" class="button green" value="Resend">
				</form>
			</div><!-- .description.section -->
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





