<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/pages/page.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/home.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 page section">
			<h1>{{ $page->title }}</h1>
			
			<div class="action">
				<a href="{{ route('admin.pages.page.edit', array('id' => $page->id)) }}" class="small blue button">Edit</a>
				{{ Form::open(array('url' => route('admin.pages.page.delete', array('id' => $page->id)), 'method' => 'DELETE')) }}
					{{ Form::submit('Delete', array('class' => 'small red button')) }}
				{{ Form::close() }}

				<div class="created_at">
					Created at
					<p>
						{{ date('F j, Y', strtotime($page->created_at)) }}
					</p>
				</div><!-- .created_at -->

				<div class="updated_at">
					Updated at
					<p>
						{{ date('F j, Y', strtotime($page->updated_at)) }}
					</p>
				</div><!-- .updated_at -->
			</div><!-- .action -->

			<div class="content">
				{!! clean($page->content) !!}
			</div><!-- .content -->
		</div><!-- .page.section -->
	</div>
</body>
</html>





