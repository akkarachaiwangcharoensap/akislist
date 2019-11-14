var select2 = require('select2');

define(function () {

	const SearchCategorySelect = {
		load: function () {
			new Vue({
			    el: '#search-category-select',
			    data: {},

			    methods: {

			    	/**
			    	 * Initialize search-category-select
			    	 * @return void
			    	 */
			    	initialize: function () {
			    		$category = $(this.$el);
			    		$category.select2();
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    }
			});
		}
	};

	return SearchCategorySelect;
});
