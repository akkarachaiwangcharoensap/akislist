define(function () {
	const ProfileNavigation = {
		load: function () {
			new Vue({
			    el: '#profile-navigation',
			    data: {
		    		$toggler: null,
		    		state: {
		    			active: false
		    		}
			    },
			    
			    methods: {
			    	initialize: function () {
			    		this.$toggler = $(this.$el).find('#menu-button-toggler');
			    	},

			    	onTogglerClicked: function () {
			    		var $menu = $(this.$el);
				    	var $toggler = this.$toggler;
				    	var $cover = $('#navigation-cover');

				    	var state = this.state;

				    	$toggler.click(function (event) {
				    		event.preventDefault();

				    		state.active = !state.active;

				    		$sections = $('.col-lg-12.col-md-12.col-sm-12');
				    		
				    		$menu.toggleClass('active');
				    		$toggler.toggleClass('active');
				    		$cover.toggleClass('active');

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
	
	return ProfileNavigation;
});




