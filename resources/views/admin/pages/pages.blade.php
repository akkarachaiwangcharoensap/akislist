<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/pages/pages.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/admin/home.js') }}"></script>
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
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 pages section">
			<h1>Admin Pages Dashboard</h1>
			<div class="content">
				@foreach($pages as $page)
					<div class="page">
						<a href="{{ route('admin.pages.page', array('id' => $page->id)) }}">
							{{ $page->title }}
						</a>
					</div>
				@endforeach
				<div class="news page">
					<a href="{{ route('admin.news') }}">
						News
					</a>
				</div><!-- .news.page -->
				<a href="{{ route('admin.pages.new') }}" class="blue button float-right">
					New
				</a>
			</div><!-- .content -->
		</div><!-- .pages.section -->
	</div>
</body>
</html>





