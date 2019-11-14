var select2 = require('select2');

define(function () {
	const AdminNavigation = {
		load: function () {
			new Vue({
			    el: '#admin-navigation',
			    data: {
					$toggler: null,
					state: {
						active: true
					},
			    },
			    
			    methods: {
			    	initialize: function () {
			    		this.$toggler = $(this.$el).find('#menu-navigation-toggler');
			    	},

			    	onTogglerClicked: function () {
			    		var $menu = $(this.$el);
				    	var $toggler = this.$toggler;
				    	
				    	var state = this.state;

				    	$toggler.click(function (event) {
				    		event.preventDefault();

				    		state.active = !state.active;

				    		if (state.active == true) {
				    			$menu.css({'left': 0});
								
								var $sections = $('.col-lg-12.col-md-12.col-sm-12');
				    			$sections.removeClass('col-lg-12 col-md-12 col-sm-12');
				    			$sections.addClass('col-lg-9 col-md-9 col-sm-9');
				    			$sections.addClass('offset-lg-3 offset-md-3 offset-sm-3');
				    			
				    			$menu.addClass('active');
				    			$toggler.addClass('active');
				    		} else {
				    			var width = $menu.outerWidth();
				    			
				    			$menu.css({'left': -1 * width});

				    			var $sections = $('.col-lg-9.col-md-9.col-sm-9');
				    			$sections.removeClass('col-lg-9 col-md-9 col-sm-9');
				    			$sections.removeClass('offset-lg-3 offset-md-3 offset-sm-3');
				    			$sections.addClass('col-lg-12 col-md-12 col-sm-12');

				    			$menu.removeClass('active');
				    			$toggler.removeClass('active');
				    		}
				    	});
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    	this.onTogglerClicked ();
			    }
			});
		}
	};

	return AdminNavigation;
});
