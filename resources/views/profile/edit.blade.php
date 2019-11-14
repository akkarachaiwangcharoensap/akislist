<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/edit.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile/edit.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@php
		$user = Auth::user();
	@endphp

	@include('templates.navigation')

	<div class="container-fluid" id="profile">
		<div class="row">
			
			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 profile section">
				<h1>Welcome, {{ $user->name }}</h1>
				<div class="content">
					<h3>Messages</h4>
					{{ Form::open(array('url' => route('profile.save'))) }}
						@csrf

						<label>
							Email
							@if ($errors->first('email') != null)
								<span class="error">({{ $errors->first('email') }})</span>
							@endif
						</label>
						{{ Form::text('email', $user->email, array('class' => 'form-control')) }}
						
						<label>
							First Name
							@if ($errors->first('first_name') != null)
								<span class="error">({{ $errors->first('first_name') }})</span>
							@endif
						</label>
						{{ Form::text('first_name', $user->first_name, array('class' => 'form-control')) }}
						
						<label>
							Last Name
							@if ($errors->first('last_name') != null)
								<span class="error">({{ $errors->first('last_name') }})</span>
							@endif
						</label>
						{{ Form::text('last_name', $user->last_name, array('class' => 'form-control')) }}
						
						{{ Form::submit('Save', array('class' => 'button blue small float-right my-2')) }}
					{{ Form::close() }}
				</div>
			</div><!-- .profile.section -->

			<div class="col-lg-12 col-md-12 col-sm-12 settings section">
				<div class="content">
					<h3>Settings</h4>
					{{ Form::open(array('url' => route('profile.deactivate'), 'class' => 'account-deactivation-form')) }}
						{{ Form::submit('Deactivate Account', array('class' => 'button red small float-left')) }}
					{{ Form::close() }}
				</div>
			</div><!-- .account.section -->
			
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





