<div class="sale-item {{ ($saleItem->live ? 'live' : 'not-live') }}">
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
			<a href="{{ route('profile.store.sale-item.edit', array('name' => str_slug($saleItem->title), 'random' => $saleItem->unique_string)) }}" class="button blue small">Edit</a>
			{!! 
				Form::open(
					array(
						'url' => route('profile.store.sale-item.delete', array('name' => str_slug($saleItem->title), 'random' => $saleItem->unique_string)), 
						'method' => 'DELETE',
						'class' => 'float-right'
					)
				) 
			!!}

				{{ Form::submit('Delete', array('class' => 'button red small')) }}
			
			{!! Form::close() !!}
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