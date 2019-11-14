require('../bootstrap');

window.Vue = require('vue');

define(function () {

	const SaleItemMap = {
		load: function () {
			new Vue({
			    el: '#sale-item-map',
			    data: {
			    	map: null,
			    	options: null,
			    	$dump: null,
			    },

			    methods: {

			    	/**
			    	 * Initialize map
			    	 * @return void
			    	 */
			    	initialize: function () {
			    		this.$dump = $('#json-dump');
			    	},

			    	/**
			    	 * @deprecated
			    	 * Get longitude and lantitude
			    	 * @return json
			    	 */
			    	getData: function () {
			    		var json = JSON.parse(this.$dump.text());
			    		
			    		return json;
			    	},

			    	/**
			    	 * Deconstructor
			    	 * @return void
			    	 */
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

	return SaleItemMap;

});
