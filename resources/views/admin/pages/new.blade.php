<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/pages/new.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/page/new.js') }}"></script>
</head>
<body>

	@include('templates.admin.navigation')

	@include('templates.admin.left-navigation')

	<div class="container-fluid">
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 new section">
			<h1>Admin New Page</h1>
			<div class="content">
				{{ Form::open(array('url' => route('admin.pages.add'), 'class' => 'form-group')) }}
					<div class="title">
						{{ Form::label('title') }}
						{{ Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'title')) }}
					</div><!-- .title -->
					<div class="description">
						{{ Form::label('content') }}
						{{ Form::textarea('content', '', array('placeholder' => 'content', 'id' => 'page-editor')) }}
					</div><!-- .description -->
					<div class="action">
						{{ Form::submit('Create', array('class' => 'green button float-right')) }}
					</div><!-- .action -->
				{{ Form::close() }}
			</div><!-- .content -->
		</div><!-- .pages.section -->
	</div>
</body>
</html>





