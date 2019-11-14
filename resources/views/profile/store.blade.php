<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile/store.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-gallery.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-thumbnail.css') }}">
		
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<script type="text/javascript" src="{{ asset('js/profile/store.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	@if ($errors->any())
		@if ($errors->first('store'))
			<div class="alert alert-warning" role="alert">
				{{ $errors->first('store') }}

				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			   		<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif
	@endif
	
	<div class="container-fluid" id="profile">
		<div class="row">

			@include('templates.profile.navigation')

			<div class="col-lg-12 col-md-12 col-sm-12 store section">
				<h1>My Store <small class="notice">Sale Items: {{ count($saleItems) }}/{{ $max }}</small></h1>
				<div class="content">
					<div class="row sale-items">
						@php
							$currency = ($geolocation->country == 'CA' ? 'CAD' : 'USD');
							$index = 0;
						@endphp
						@foreach ($saleItems as $saleItem)
							<div class="col-lg-6 col-md-6 col-sm-12">
								@include('templates.profile.sale-item', array('saleItem' => $saleItem))
							</div><!-- .col-lg-6.col-md-6.col-sm-12 -->
							@php
								$index++;
							@endphp
						@endforeach
					</div><!-- .sale-items -->
					<a href="{{ route('profile.store.new') }}" class="button blue float-right new-button">New</a>
				</div><!-- .content -->
			</div><!-- .profile.section -->
		</div><!-- .row -->
	</div><!-- .container -->
</body>
</html>





