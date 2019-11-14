<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/auth/email.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
</head>
<body>

	@include('templates.navigation')

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 description reset section">
				<h1>
					Reset Your Password
				</h1>
				<hr>
                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" class="form-group">
                    @csrf
                    <label>
                    	Email
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="youraddress@example.com" required="">
                    <input type="submit" name="requestSubmit" class="button blue float-right mt-4" value="Request">

                </form>
			</div><!-- .reset.section -->
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>

@include('templates.footer')