<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/store/upload.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/select2-select.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile-navigation.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/profile/store/upload.js') }}"></script>
</head>

<body>

	@php
		$user = Auth::user();
	@endphp

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 upload section">
				<h1>Upload Images</h1>
				<div class="content">
					@csrf
					<div class="upload">
						<div class="files">
							@php
								$index = 0;
							@endphp
							@foreach ($uploads as $upload)
								@include('profile.store.upload.file', array('url' => upload_url($upload), 'index' => $index))

								@php 
									$index++;
								@endphp
							@endforeach
						</div>

						<h1 class="drag-and-drop">Drop your images here</h1>

						<label for="images-upload" id="images-upload"></label>
						{{ Form::file('images-upload', array('multiple' => true)) }}
						<div class="status">
							<span>Status: </span>
							<div class="message">
								{{-- <p class="success">File(s): uploaded.</p> --}}
								{{-- <p class="error">Error(s): Please verify your file(s) [Allow extensions: jpg, jpeg, png]</p> --}}
							</div>
						</div><!-- .message -->
					</div><!-- .upload -->
					@php
						$route = Route::current()->parameters();
						$json = array(
							'name' => $route['name'],
							'random' => $route['random'],
							'total' => count($uploads)
						);

						$json = json_encode($json);
					@endphp
					{{ Form::hidden('json-dump', $json, array('id' => 'json-dump')) }}
					<div class="action">
						<a href="{{ route('profile.store.sale-item.edit', 
							array(
								'name' => $route['name'],
								'random' => $route['random']
							)
						) 
						}}" class="button green float-left">Back</a>
						<a href="{{ route('profile.store.sale-item.finish',
							array(
								'name' => $route['name'],
								'random' => $route['random']
							)
						)
						}}" class="button blue float-right">Next</a>
					</div><!-- .action -->
				</div><!-- .content -->
			</div><!-- .profile.section -->
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





