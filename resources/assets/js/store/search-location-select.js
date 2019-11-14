var select2 = require('select2');

define(function () {
	const SearchLocationSelect = {

		load: function () {
			new Vue({
			    el: '#search-location-select',
			    data: {
			    	$dump: null
			    },

			    methods: {

			    	/**
			    	 * Initialize location-search-select
			    	 * @return void
			    	 */
			    	initialize: function () {

			    		this.$dump = $('#json-dump');

			    		var data = JSON.parse(this.$dump.val());
			    		var $location = $(this.$el);

						$location.select2({
			    			placeholder: 'Search your city',
			    			minimumInputLength: 3,
			    			ajax: {
			    				url: '/request/geolocation/similar',
				    			headers: {
				    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    			},
			    				delay: 500,
			    				method: 'POST',

			    				// Sending a request
			    				data: function (param) {

			    					if (!param.term) {
			    						return;
			    					}

			    					var query = {
			    						name: param.term,
			    						country: data.country
			    					}

			    					return query;
			    				},

			    				// Retrieving a response
			    				processResults: function (response) {

			    					_.each(response.data, function (obj, index) {
		    							obj.id = obj.name;
			    						obj.text = obj.name;

			    						delete obj.name;
			    					});

			    					$location.empty().trigger('change');

			    					return {
			    						results: response.data
			    					}
			    				},
			    				cache: true
			    			}
			    		});
			    	},

			    	deconstruct: function () {
			    		this.$dump.remove();
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    	this.deconstruct ();
			   	}
			});
		}
	}

	return SearchLocationSelect;
});