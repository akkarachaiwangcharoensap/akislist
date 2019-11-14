<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/news/news.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/news/news.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 news section">
			<h1>Admin News Posts</h1>
			<div class="content">
				@foreach ($news as $post)
					<div class="post">
						<a href="{{ route('admin.news.post', array('id' => $post->id)) }}">
							{{ $post->title }}
						</a>
					</div>
				@endforeach
				<a href="{{ route('admin.news.new') }}" class="blue button float-right mt-2">
					New
				</a>
			</div><!-- .content -->
		</div><!-- .news.section -->
	</div>
</body>
</html>





