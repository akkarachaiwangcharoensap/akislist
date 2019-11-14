<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/news/post.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/news/news.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 post section">
			<h1>{{ $post->title }}</h1>
			
			<div class="action">
				<a href="{{ route('admin.news.post.edit', array('id' => $post->id)) }}" class="small blue button">Edit</a>
				{{ Form::open(array('url' => route('admin.news.post.delete', array('id' => $post->id)), 'method' => 'DELETE')) }}
					{{ Form::submit('Delete', array('class' => 'small red button')) }}
				{{ Form::close() }}

				<div class="created_at">
					Created at
					<p>
						{{ date('F j, Y', strtotime($post->created_at)) }}
					</p>
				</div><!-- .created_at -->

				<div class="updated_at">
					Updated at
					<p>
						{{ date('F j, Y', strtotime($post->updated_at)) }}
					</p>
				</div><!-- .updated_at -->
			</div><!-- .action -->

			<div class="content">
				{!! clean($post->content) !!}
			</div><!-- .content -->
		</div><!-- .post.section -->
	</div>
</body>
</html>





