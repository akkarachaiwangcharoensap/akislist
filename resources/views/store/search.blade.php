<!DOCTYPE html>
<html>
<head>
	@include('templates.metadata')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/utility.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/select2-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-gallery.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/store-navigation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/store/sale-item-thumbnail.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals/report-modal.css') }}">

	<link rel="canonical" href="{{ route('store.search.category', array('category' => str_slug($storeCategory->name))) }}" />

	<script type="text/javascript" src="{{ asset('js/store.js') }}"></script>

	@include('templates.google.google-analytics')
</head>
<body>

	@include('templates.navigation')
	@php
		$pagination = !empty($saleItems) ? $saleItems->toArray() : null;
	@endphp
	@if (Session::has('message'))
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<p>{{ Session::get('message') }}</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@elseif (empty($errors->all()) == false)
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach ($errors->all() as $message)
				<p>{{ $message }}</p>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	<div class="container-fluid" id="store">
		<div class="row">
			
			@include('templates.store.store-navigation')
			
			<div class="col-lg-12 col-md-12 col-sm-12 store section">
				<div class="current-location">
					<h4>{{ Session::get('location') }}</h4>	
				</div><!-- .current-location -->
				
				<h1>Store</h1>
				<hr>
				<div class="row sale-items">
					@php $index = 0; @endphp
					@foreach ($saleItems as $saleItem)
						@php
							$url = route('store.sale-item.show', array(
											'category' => str_slug($saleItem->category->name),
											'sale-item' => str_slug($saleItem->title),
											'unique-string' => $saleItem->unique_string
										)
									);
						@endphp
						<div class="col-lg-4 col-md-6 col-sm-12">
							@include('templates.store.sale-item', array(
								'saleItem' => $saleItem,
								'index' => $index,
							))
						</div><!-- .col-lg-4.col-md-4.col-sm-4 -->
						@php $index++; @endphp
					@endforeach
				</div><!-- .sale-items -->

				@if (!empty($pagination))
					@php
						$totalCurrent = $pagination['per_page'] * ($pagination['current_page'] - 1) + count($pagination['data']);
					@endphp
					<div class="store-footer">
						<ul class="pagination">
							<li class="page-item go-back">
								@if ($pagination['current_page'] - 1 > 0)
									<a href="?page={{ $pagination['current_page'] - 1 }}" class="fa fa-angle-left page-item"></a>
								@endif
							</li>
							<li class="page-item content">
								<span class="page-item">{{ $totalCurrent }} / {{ $pagination['total'] }}</span>
							</li>
							<li class="page-item go-next">
								@if ($pagination['current_page'] != $pagination['last_page'])
									<a href="?page={{ $pagination['current_page'] + 1 }}" class=" fa fa-angle-right page-item"></a>
								@endif
							</li>
						</ul><!-- .pagination -->
					</div><!-- .store-footer -->
				@endif
			</div><!-- .description.section -->
		</div><!-- .row -->

		@php
			$filtered = array(
				'country' => $geolocation->country,
				'city' => $geolocation->city,
				'region' => $geolocation->region,
				'loc' => $geolocation->loc
			);

			$json = json_encode($filtered);
		@endphp
		<input type="hidden" id="json-dump" value="{{ $json }}">
	</div><!-- .container -->

	@include('modals.report-modal', array('reportReasons' => $reportReasons))

	<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "BreadcrumbList",
		  "itemListElement": [{
		    "@type": "ListItem",
		    "position": 1,
		    "name": "{{ $storeCategory->name }}",
		    "item": "{{ route('store.search.category', array('category' => str_slug($storeCategory->name))) }}"
		  }]
		}
	</script>
</body>
</html>





