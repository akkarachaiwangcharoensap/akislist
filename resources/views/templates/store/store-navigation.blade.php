<div class="search section" id="store-navigation">
				
	<a href="#" id="store-navigation-toggler" class="">
		<span class="fas fa-angle-left"></span>
	</a>

	{!! Form::open(array('url' => route('store.search'), 'class' => 'form-group search-form')) !!}
		<h2>Search</h2>

		@php
			$location = (!isset($location)) ? $geolocation->city.', '.$geolocation->region : $location;
		@endphp

		<div class="my-2 mt-4">
			{!! (($errors->first('keyword')) ? '<small class="error">'.$errors->first('keyword').'</small>' : '') !!}
			{{ Form::text('keyword', '', array('class' => 'form-control', 'placeholder' => 'keyword', 'id' => 'keyword-input')) }}
		</div>
			
		<div class="my-2">
			{!! (($errors->first('category')) ? '<small class="error">'.$errors->first('category').'</small>' : '') !!}
			{{ Form::select('category', $storeCategories, ((isset($storeCategory)) ? $storeCategory->id : 0), array('class' => 'form-control', 'id' => 'search-category-select')) }}	
		</div>
			
		<div class="my-2">
			{!! (($errors->first('location')) ? '<small class="error">'.$errors->first('location').'</small>' : '') !!}
			{{ Form::select('location', array($location => $location), false, array('class' => 'form-control', 'id' => 'search-location-select')) }}	
		</div>
		
		{{ Form::submit('Search', array('class' => 'button blue small float-right my-2')) }}

	{!! Form::close() !!}
</div><!-- .search.section -->

<div class="navigation-cover" id="navigation-cover">
	
</div><!-- .navigation-cover -->