<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/gallery.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals/report-modal.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals/user-contact-modal.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals/unauthorized-modal.css') }}">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	
	<script src="https://maps.googleapis.com/maps/api/js?key={{ config('api.google') }}"></script>
	<script type="text/javascript" src="{{ asset('js/sale-item.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	@if (empty($errors->all()) == false)
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach ($errors->all() as $message)
				<p>{{ $message }}</p>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@elseif (Session::has('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
				<p>{{ Session::get('success') }}</p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
		</div>
	@endif
	
	<div class="container-fluid" id="profile-store-preview">
		<div class="row sale-item-row">
			<div class="col-lg-12 col-md-12 col-sm-12 sale-item section">
				<div class="header">
					<div class="links">
						<a href="{{ route('store') }}" class="link">Store</a>
						<span>/</span>
						<a href="{{ route('store.search.category', array('category' => str_slug($saleItem->category->name))) }}" class="link">{{ $saleItem->category->name }}</a>
					</div>
					<h1>{{ $saleItem->title }}</h1>
					<h2 class="price">$ {{ $saleItem->price }}</h2>
				</div><!-- .header -->

				<div class="cover" id="gallery">
					@foreach ($saleItem->uploads as $upload)
						<img src="{{ upload_url($upload) }}" class="image">
					@endforeach
					<div class="control">
						<div class="next">
							<span class="fas fa-chevron-right"></span>
						</div><!-- .next -->
						<div class="previous">
							<span class="fas fa-chevron-left"></span>
						</div><!-- .previous -->
					</div><!-- .control -->
				</div><!-- .cover -->

				<div class="social-media">
					<span>Share: </span>
					<ul>
						<li>
							<a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}" class="link ml-2" target="_blank">Facebook</a>
						</li>
						<li>
							<a href="https://twitter.com/intent/tweet?url={{ URL::current() }}" class="link" target="_blank">Twitter</a>
						</li>
					</ul>
				</div><!-- .socialmedia -->

				<div class="row">
					<div class="col-lg-7 col-md-7 col-sm-7 description">
						<p>{!! clean($saleItem->description) !!}</p>
					</div><!-- .description -->
					<div class="col-lg-5 col-md-5 col-sm-5 metadata">
						<div class="date">
							@php
								$past = time() - strtotime($saleItem->created_at);

								$seconds = $past;
								$mins = $seconds / 60;
								$hours = $mins / 60;
								$days = $hours / 24;
								
								$activeTime = null;
								
								// Using days format
								if ($days > 1) {
									$activeTime = round($days) . ' day(s)';
								}
								// Using hours format
								else if ($hours > 1) {
									$activeTime = round($hours) . ' hr(s)';
								} 
								// Using minutes format
								else if ($mins > 1) {
									$activeTime = round($mins) . ' min(s)';
								} 
								// Using seconds format
								else {
									$activeTime = round($seconds) . ' sec(s)';
								}

							@endphp
							<span>Date: {{ date('M j', strtotime($saleItem->created_at)) }}</span>
							<span>Time: {{ $activeTime }} ago</span>
						</div><!-- .date -->
						<div class="seller">
							<h4>Seller <a class="warning link ml-1 report" href="#">Report</a></h4>
							<p>Name: {{ $saleItem->author->name }}</p>
							<a href="#" class="button blue float-right contact">Contact</a>
						</div><!-- .seller -->
						<div class="location">
							<h4>Location: {{ $saleItem->location }}</h4>
							{{-- <div class="map" id="sale-item-map">
							 --}}<!-- .map -->
							<div class="map" id="sale-item-map">
								<iframe
									width="350"
									height="350"
									frameborder="0" 
									style="border:0"
									src="https://www.google.com/maps/embed/v1/place?q={{ $saleItem->country_code }}, {{ $saleItem->location }}&zoom=10&key={{ config('api.google') }}">
								</iframe>
							</div>
						</div><!-- .location -->
					</div><!-- .metadata -->
				</div>
				
			</div><!-- .sale-item.section -->
		</div><!-- .row -->
	</div><!-- .container -->

	@php
		$json = json_encode(array('loggedIn' => (Auth::user() != null)));
	@endphp

	{{ Form::hidden('json-dump', $json, array('id' => 'json-dump')) }}

	@include('modals.report-modal', array('reportReasons' => $reportReasons, 'action' => URL::current() . '/report'))
	@include('modals.user-contact-modal', array('user' => $user, 'saleItem' => $saleItem))
	@include('modals.unauthorized-modal')

	@include('templates.footer')
</body>
</html>





