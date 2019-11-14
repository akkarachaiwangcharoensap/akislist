<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/store/finish.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile-navigation.js') }}"></script>
</head>

<body>

	@php
		$user = Auth::user();
	@endphp

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 finish section">
				<h1>Finish</h1>
				<div class="content">
					@php
						$route = Route::current()->parameters();
					@endphp
					<div class="action">
						<a href="{{ route('profile.store.sale-item.upload', 
							array(
								'name' => $route['name'],
								'random' => $route['random']
							)
						) 
						}}" class="button green float-left">Back</a>
						{{ Form::open(array('url' => route('profile.store.post', array('name' => str_slug($saleItem->title), 'random' => $saleItem->unique_string)))) }}
							@csrf
							{{ Form::hidden('active', true) }}
							<input type="submit" class="button red float-right" name="postSubmit" value="Post">
						{{ Form::close() }}
					</div><!-- .action -->
				</div><!-- .content -->
			</div><!-- .profile.section -->
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





