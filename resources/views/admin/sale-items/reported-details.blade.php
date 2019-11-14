<!DOCTYPE html>
<html>
<head>
	@include('templates.admin.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/left-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/sale-items/reported-details.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-gallery.css') }}">
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
		<div class="col-lg-9 col-md-9 col-sm-9 offset-lg-3 offset-md-3 offset-sm-3 reported-users-details section">
			
			<h1>Reported Sale Items (details)</h1>
			
			<div class="sale-items-list">
				<h4>Sale Items</h4>
				@php
					$index = 0;
				@endphp
				@foreach ($reports as $report)
					<div class="sale-item">
						<div class="info">
							<div class="name">
								{{ $report->saleItem->title }}
							</div>
							<div class="gallery" id="{{ 'gallery-id-'.$index }}">
								@foreach ($report->saleItem->uploads as $upload)
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
							</div><!-- .gallery -->
							
							<div class="reason">
								<b>Reason:</b>
								<p>{{ $report->category->name }}</p>
							</div><!-- .reason -->
							
							<div class="description">
								<b>Details:</b>
								<p>{{ $report->message }}</p>
							</div><!-- .description -->

							<div class="category">
								<a href="{{ route('store.search.category', array('category' => str_slug($report->saleItem->category->name))) }}">
									{{ $report->saleItem->category->name }}
								</a>
							</div><!-- .category -->

							<div class="location">
								{{ Form::open(array('url' => route('store.search'), 'method' => 'POST', 'id' => 'search-location-based-form')) }}
									<button type="submit" form="search-location-based-form">
										{{ shorten_location($report->saleItem->location) }}
									</button>

									{{ Form::hidden('location', $report->saleItem->location) }}
									{{ Form::hidden('category', $report->saleItem->category->id) }}
								{{ Form::close() }}
							</div><!-- .location -->						
						</div><!-- .info -->
						<div class="action">
							<div class="link">
								<a href="{{ route('store.sale-item.show', 
									array(
										'category' => str_slug($report->saleItem->category->name),
										'saleItem' => str_slug($report->saleItem->title),
										'uniqueString' => $report->saleItem->unique_string
									))
								}}" class="blue button">
									Investigate
								</a>
							</div><!-- .link -->

							{{ Form::open(array('url' => route('admin.store.deactivate', 
									array(
										'name' => str_slug($report->saleItem->title),
										'uniqueString' => $report->saleItem->unique_string
									)
								))) 
							}}
								{{ Form::submit('Deactivate', array('class' => 'red button')) }}
							{{ Form::close() }}

							{{ Form::open(array('url' => route('admin.users.user.criminalize', array(
									'name' => str_slug($report->saleItem->author->name),
									'uniqueString' => $report->saleItem->author->unique_string
								)))) 
							}}
								{{ Form::submit('Criminal', array('class' => 'purple button ml-2')) }}
							{{ Form::close() }}

							<div class="link">
								<a href="{{ route('admin.users.user', 
									array(
										'name' => str_slug($report->receiver->name), 
										'uniqueString' => $report->receiver->unique_string)
									) 
								}}" class="green button">{{ $report->receiver->name }}</a>
							</div><!-- .link -->

							<div class="link">
								<a class="button" href="#">
									{{ ($report->saleItem->active) ? 'Active' : 'Banned' }}
								</a>
							</div><!-- .link -->
						</div>
					</div>
					@php
						$index++;
					@endphp
				@endforeach
			</div><!-- .monthly-statistics -->
		</div>	
	</div>
</body>
</html>





