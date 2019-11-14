define(function () {
	const SaleItem = {
		load: function (id) {
			new Vue({
			    el: id,
			    data: {
			    	$gallery: null,
			    	$nextButton: null,
			    	$previousButton: null,
			    	$images: null,
			    	index: 0,
			    	min: 0,
			    	max: 0,
			    },

			    methods: {

			    	/**
			    	 * Initialize images gallery
			    	 * @return void
			    	 */
			    	initialize: function () {

			    		// initialize elements
			    		this.$gallery = $(this.$el);
			    		this.$nextButton = this.$gallery.find('.next').first();
			    		this.$previousButton = this.$gallery.find('.previous').first();

			    		this.$images = this.$gallery.find('.image');

			    		this.index = 0;
			    		this.max = this.$images.length;

			    		// Show the first image
			    		this.$images.eq(this.index).addClass ('active');

			    		this.onGalleryHover ();
			    		this.onNextClick ();
			    		this.onPreviousClick ();
			    	},

			    	/**
			    	 * Show the next image
			    	 * @return void
			    	 */
			    	onNextClick: function () {
			    		var $previous = null;
			    		var $next = null;

			    		// on next button click
			    		this.$nextButton.click($.proxy(function () {

			    			// show the next image
				    		if (this.index + 1 < this.max) {
				    			$previous = this.$images.eq(this.index);
				    			$next = this.$images.eq(this.index + 1);

				    			$previous.removeClass ('active');
				    			$next.addClass ('active');

				    			this.index++;
				    		} 
				    		// show the starting image
				    		else {
				    			$previous = this.$images.eq(this.index);
				    			$next = this.$images.eq(0);

				    			$previous.removeClass ('active');
				    			$next.addClass ('active');

				    			this.index = 0;
				    		}

			    		}, this));
			    	},

			    	/**
			    	 * Show the previous image
			    	 * @return void
			    	 */
			    	onPreviousClick: function () {
			    		var $previous = null;
			    		var $next = null;

			    		// on next button click
			    		this.$previousButton.click($.proxy(function () {

			    			// show the previous image
				    		if (this.index - 1 >= this.min) {
				    			$previous = this.$images.eq(this.index);
				    			$next = this.$images.eq(this.index - 1);

				    			$previous.removeClass ('active');
				    			$next.addClass ('active');

				    			this.index--;
				    		} 
				    		// show the starting image
				    		else {
				    			$previous = this.$images.eq(this.index);
				    			$next = this.$images.eq(this.max - 1);

				    			$previous.removeClass ('active');
				    			$next.addClass ('active');

				    			this.index = this.max - 1;
				    		}

			    		}, this));
			    	},

			    	/**
			    	 * When gallery is hovered
			    	 * @return void
			    	 */
			    	onGalleryHover: function () {
			    		this.$gallery.hover(

			    			// hover in
			    			function () {
			    				$(this).addClass('active');
			    			},

			    			// hover out
			    			function () {
			    				$(this).removeClass('active');
			    			}
			    		);
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    }
			});
		}
	}

	return SaleItem;
});
