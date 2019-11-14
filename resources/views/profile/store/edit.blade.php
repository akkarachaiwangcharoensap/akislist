<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/store/edit.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/select2-select.css') }}">

	<script type="text/javascript" src="{{ asset('js/profile/store/edit.js') }}"></script>
</head>

<body>

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 edit section">
				<h1>Edit</h1>
				<div class="content">
					{!! Form::open(array('url' => route('profile.store.save', array('name' => str_slug($saleItem->title), 'random' => $saleItem->unique_string)), 'class' => 'form-group', 'method' => 'POST')) !!}
						@csrf
						<div class="title">
							<label>Title {!! !$errors->first('title') == null ? '<small class="text-danger">'.$errors->first('title').'</small>' : '' !!}</label>

							{{ Form::text('title', $saleItem->title, array('class' => 'form-control', 'placeholder' => 'title')) }}
							
							@if ($saleItem->live == false)
								<a class="button red small">Disabled</a>
							@else
								<a class="button green small">Enabled</a>
							@endif
						</div><!-- .title -->
						
						<div class="category">
							<label>Category {!! !$errors->first('store_category_id') == null ? '<small class="text-danger">'.$errors->first('category').'</small>' : '' !!}</label>
							{{ Form::select('store_category_id', $categories, $saleItem->category->id, array('class' => 'form-control', 'id' => 'search-category-select')) }}	
						</div><!-- .category -->

						<div class="description">
							<label>Description {!! !$errors->first('description') == null ? '<small class="text-danger">'.$errors->first('description').'</small>' : ''!!}</label>
							{{ Form::textarea('description', $saleItem->description, array('class' => 'form-control', 'placeholder' => 'description', 'rows' => 10, 'id' => 'sale-item-editor')) }}
						</div><!-- .description -->

						<div class="price">
							<label>Price ($) {!! !$errors->first('price') == null ? '<small class="text-danger">'.$errors->first('price').'</small>' : '' !!}</label>
							{{ Form::text('price', $saleItem->price, array('class' => 'form-control', 'placeholder' => '99.99')) }}
						</div><!-- .price -->

						<div class="keywords">
							<label>Keywords {!! !$errors->first('keywords') == null ? '<small class="text-danger">'.$errors->first('keywords').'</small>' : '' !!}</label>
							{{ Form::text('keywords', $saleItem->keywords, array('class' => 'form-control', 'placeholder' => 'dog, cat, monkey')) }}
						</div><!-- .keywords -->

						<div class="location">
							<label>Location {!! !$errors->first('location') == null ? '<small class="text-danger">'.$errors->first('location').'</small>' : '' !!}</label>
							{{ Form::select('location', array($saleItem->location => $saleItem->location), $saleItem->location, array('class' => 'form-control', 'id' => 'search-location-select')) }}
						</div><!-- .location -->

						<div class="enable">
							<label>Enable <small>(If it is not checked, it will not show on the store.)</small></label>
							{{ Form::hidden('live', 0) }}
							{{ Form::checkbox('live', 1, $saleItem->live, array('class' => 'form-control')) }}
						</div><!-- .enable -->

						<div class="sold-to">
							@php
								$default = (isset($saleItem->soldTo)) ? $saleItem->soldTo->unique_string : 0;

								$before = 'No One';
								$contacts = $contacts->prepend($before);
							@endphp
							<label>Sold To <small>(When you select a name from your list and submitted. Your post will be closed down.)</small></label>
							{{ Form::select('sold_to', $contacts, $default, array('class' => 'form-control')) }}
						</div>
						{{ Form::hidden('country_code', $geolocation->country) }}
						
						<div class="action">
							<a href="{{ route('profile.store.sale-item.preview', array('name' => str_slug($saleItem->title), 'random' => $saleItem->unique_string)) }}" target="_blank" class="button green">Preview</a>
							<a href="{{ route('profile.store.sale-item.upload', array(
					    		'name' => str_slug($saleItem->title),
					    		'random' => $saleItem->unique_string
					    	)) }}" class="button green float-right">
					    		Next
					    	</a>
							{{ Form::submit('Save', array('class' => 'button blue float-right mr-3', 'name' => 'saveSubmit')) }}
						</div><!-- .action -->
					
					{!! Form::close() !!}
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





