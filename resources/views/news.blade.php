<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/news.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">

	<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 news section">
				<div class="content">
					<h1>
						News
					</h1>
					<hr>
					<div class="posts">
						@foreach ($posts as $post)
							<div class="post">
								<h3>{{ $post->title }}</h3>
								{!! clean($post->content) !!}
								<div class="date">
									posted on: {{ date('F j, Y', strtotime($post->created_at)) }}
								</div>
							</div>
						@endforeach
					</div>
				</div><!-- .content -->
			</div><!-- .header.section -->
		</div><!-- .row -->
	</div>

	@include('templates.footer')
</body>
</html>





