@php
	$url = route('store.sale-item.show', array(
					'category' => str_slug($saleItem->category->name),
					'saleItem' => str_slug($saleItem->title),
					'uniqueString' => $saleItem->unique_string
				)
			);
@endphp
<div class="sale-item">
	<div class="metadata">
		<div class="date">
			<span>{{ date('M j', strtotime($saleItem->created_at)) }}</span>
		</div><!-- .date -->
		<div class="price">
			<span>${{ $saleItem->price }}</span>
		</div><!-- .price -->
	</div><!-- .metadata -->
	<div class="description">
		<div class="gallery" id="{{ 'gallery-id-'.$index }}">
			@php
				// dd ('ya');
			@endphp
			@foreach ($saleItem->uploads as $upload)
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
		</div>

		<p>{{ $saleItem->title }}</p>
		<div class="action">
			<a href="{{ $url }}" class="button blue small">View</a>
			<a href="#" class="button red small report" data-sale-item="{{ $url . '/report'}}">Report</a>
		</div>
	</div><!-- .description -->
	<div class="category">
		<a href="{{ route('store.search.category', array('category' => str_slug($saleItem->category->name))) }}">
			{{ $saleItem->category->name }}
		</a>
	</div><!-- .category -->
	<div class="location">
		{{ Form::open(array('url' => route('store.search'), 'method' => 'POST', 'id' => 'search-location-based-form')) }}
			<button type="submit" form="search-location-based-form">
				{{ shorten_location($saleItem->location) }}
			</button>

			{{ Form::hidden('location', $saleItem->location) }}
			{{ Form::hidden('category', $saleItem->category->id) }}
		{{ Form::close() }}
	</div><!-- .location -->
</div><!-- .sale-item -->