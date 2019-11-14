<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>

	@include('templates.metadata')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/pages/edit.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/page/new.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@if (Session::has('success'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<p>{{ Session::get('success') }}</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 edit section">
			<h1>Admin Edit Page</h1>
			<div class="content">
				{{ Form::open(array('url' => route('admin.pages.page.save', array('id' => $page->id)), 'class' => 'form-group')) }}
					<div class="title">
						{{ Form::label('title') }}
						{{ Form::text('title', $page->title, array('class' => 'form-control', 'placeholder' => 'title')) }}
					</div><!-- .title -->
					<div class="description">
						{{ Form::label('content') }}
						{{ Form::textarea('content', $page->content, array('placeholder' => 'content', 'id' => 'page-editor')) }}
					</div><!-- .description -->
					<div class="action">
						{{ Form::submit('Save', array('class' => 'blue button float-right')) }}
					</div><!-- .action -->
				{{ Form::close() }}
			</div><!-- .content -->
		</div><!-- .pages.section -->
	</div>
</body>
</html>





