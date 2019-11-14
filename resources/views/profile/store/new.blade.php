<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/store/new.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/select2-select.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/profile/store/new.js') }}"></script>

	@include('templates.google.google-analytics')
</head>

<body>

	@php
		$user = Auth::user();
		$location = $geolocation->city.', '.$geolocation->region;
	@endphp

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 new section">
				<h1>Post New Sale Item</h1>
				<div class="content">
					{{ Form::open(array('url' => route('profile.store.add'), 'method' => 'POST', 'class' => 'form-group', 'files' => true, 'id' => 'add-form')) }}
						@csrf
						<div class="title">
							<label>Title {!! !$errors->first('title') == null ? '<small class="text-danger">'.$errors->first('title').'</small>' : '' !!}</label>
							{{ Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'title')) }}
							<a class="button red small">Disabled</a>
						</div><!-- .title -->
						
						<div class="category">
							<label>Category {!! !$errors->first('store_category_id') == null ? '<small class="text-danger">'.$errors->first('category').'</small>' : '' !!}</label>
							{{ Form::select('store_category_id', $categories, 0, array('class' => 'form-control', 'id' => 'search-category-select', 'ondragover' => 'ImagesUpload.onDrag(event);')) }}	
						</div><!-- .category -->

						<div class="description">
							<label>Description {!! !$errors->first('description') == null ? '<small class="text-danger">'.$errors->first('description').'</small>' : '' !!}</label>
							{{ Form::textarea('description', '', array('class' => 'form-control', 'placeholder' => 'description', 'rows' => 10, 'id' => 'sale-item-editor')) }}
						</div><!-- .description -->

						<div class="price">
							<label>Price ($) {!! !$errors->first('price') == null ? '<small class="text-danger">'.$errors->first('price').'</small>' : '' !!}</label>
							{{ Form::text('price', '', array('class' => 'form-control', 'placeholder' => '99.99')) }}
						</div><!-- .price -->

						<div class="keywords">
							<label>Keywords {!! !$errors->first('keywords') == null ? '<small class="text-danger">'.$errors->first('keywords').'</small>' : '' !!}</label>
							{{ Form::text('keywords', '', array('class' => 'form-control', 'placeholder' => 'dog, cat, monkey')) }}
						</div><!-- .keywords -->

						<div class="location">
							<label>Location {!! !$errors->first('location') == null ? '<small class="text-danger">'.$errors->first('location').'</small>' : '' !!}</label>
							{{ Form::select('location', array($location => $location), $location, array('class' => 'form-control', 'id' => 'search-location-select')) }}
						</div><!-- .location -->

						{{ Form::hidden('country_code', $geolocation->country, array('id' => 'country_code')) }}

						<div class="action">
							{{ Form::submit('Next', array('class' => 'button blue float-right')) }}
							{{-- <input type="submit" class="button blue float-right ml-3" name="saveSubmit" value="Next"> --}}
							{{-- <input type="submit" class="button red float-right" name="postSubmit" value="Post"> --}}
						</div><!-- .action -->
					{{ Form::close() }}
				</div><!-- .content -->
			</div><!-- .profile.section -->
			@php
				$filtered = array(
					'country' => $geolocation->country,
					'city' => $geolocation->city,
					'region' => $geolocation->region,
					'loc' => $geolocation->loc
				);

				$json = json_encode($filtered);
			@endphp
			<input type="hidden" id="json-dump" value="{{ $json }}">
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





