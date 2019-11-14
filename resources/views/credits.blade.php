<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/credits.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/credits.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 description section">
				<h1>{{ $page->title }}</h1>
				{!! clean($page->content) !!}
			</div><!-- .description -->
		</div><!-- .row -->
	</div><!-- .container -->

	@include('templates.footer')
</body>
</html>





