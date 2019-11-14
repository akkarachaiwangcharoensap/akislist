<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/settings.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile/settings.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@php
		$user = Auth::user();
	@endphp

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 account-settings section">
				<div class="content">
					<h3>Account <small><a href="{{ route('profile.edit') }}">Edit</a></small></h4>
					<ul>
						<li>
							Email: {{ $user->email }}
						</li>
						<li>
							First name: {{ $user->first_name }}
						</li>
						<li>
							Last name: {{ $user->last_name }}
						</li>
					</ul>
					{{ Form::open(array('url' => route('profile.deactivate'), 'class' => 'account-deactivation-form')) }}
						{{ Form::submit('Deactivate Account', array('class' => 'button red small float-left')) }}
					{{ Form::close() }}
				</div><!-- .content -->
			</div><!-- .account.section -->
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





