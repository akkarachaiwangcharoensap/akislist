<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@php
		$user = Auth::user();
	@endphp

	@include('templates.navigation')

	@include('templates.profile.navigation')

	<div class="container-fluid" id="profile">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 profile section">
				<h1>Welcome, {{ $user->name }}</h1>
			</div><!-- .profile.section -->

			<div class="col-lg-12 col-md-12 col-sm-12 account-settings section">
				<div class="content">
					<h3>Account <small><a href="{{ route('profile.edit') }}">Edit</a></small></h4>
					<ul>
						<li>
							<span><b>Email:</b></span> {{ $user->email }}
						</li>
						<li>
							<span><b>First name:</b></span> {{ $user->first_name }}
						</li>
						<li>
							<span><b>Last name:</b></span> {{ $user->last_name }}
						</li>
					</ul>
					{{ Form::open(array('url' => route('profile.deactivate'), 'class' => 'account-deactivation-form')) }}
						{{ Form::submit('Deactivate Account', array('class' => 'button red small float-left')) }}
					{{ Form::close() }}
				</div>
			</div><!-- .account.section -->
			
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





