<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
	
	<link rel="canonical" href="{{ route('home') }}" />

	<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	@if ($errors->any())
		@if ($errors->first('account') != null)
			<div class="alert alert-danger" role="alert">
				{{ $errors->first('account') }}

				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			   		<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif
	@endif

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 header section">
				<div class="content">
					<div class="feature-text">
						<h1>
							Buy or Sell Securely
						</h1>
						<p class="my-3">
							Search to buy and sell cheap used items securely. Whether it is used books, laptops, computers, phones, furnitures, and many others. You can find or sell them here.
						</p>
						<a href="{{ route('getting_started') }}" class="button green my-6">Get Started</a>
					</div>
				</div><!-- .content -->
			</div><!-- .header.section -->
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 about section">
				<div class="content">
					<h1>
						About
					</h1>
					<p class="my-4 px-4">
						Are you tired of buying used items and just a few days later it is broken? Have you ever felt insecure when trying to buy used items for cheaper price? Have you ever made a deal, but just to learn after that he/she sold the item to someone else so that all the time you spent negotiating was a waste? This service is trying to solve the issue. AkisList is a free service that helps you buy or sell used items securely and professionally. We try our best to make sure that the usage of our service is secure and in a professional manner. We try our hardest to eliminate scammers, frauds, exploiters or any illegitimate items being sold on our platform. We hope you will feel secure when using our service.
					</p>
				</div><!-- .content -->
			</div><!-- .about.section -->
		</div><!-- .row -->
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 feature section">
				<div class="content">
					<h1>
						Features
					</h1>
					<div class="features my-5">
						<div class="buyer">
							<h2>Buyer</h2>
							<hr>
							<p>Save money and buy legitimate items.</p>
							<a href="{{ route('store') }}" class="button blue float-right">Buy</a>
						</div>
						<h2 class="or">or</h2>
						<div class="seller">
							<h2>Seller</h2>
							<hr>
							<p>Sell used items securely in professional manner</p>
							<a href="{{ route('profile.store') }}" class="button red float-right">Sell</a>
						</div>
					</div><!-- .features -->
				</div><!-- .content -->
			</div><!-- .feature -->
		</div><!-- .row -->
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 contact section">
				<div class="content">
					<h1>Contact</h1>
					<p class="my-4 px-4">
						If you have any question or concern, feel free to contact us on our <a href="{{ route('contact-us') }}">contact</a> page. If you think your questions will benefit our community. Please <a href="{{ route('contact-us') }}">send us</a> a FAQ questionaire. We will try our best to answer your questions.
					</p>
				</div><!-- .content -->
			</div><!-- .contact.section -->
		</div><!-- .row -->
	</div>

	@include('templates.footer')
</body>
</html>





