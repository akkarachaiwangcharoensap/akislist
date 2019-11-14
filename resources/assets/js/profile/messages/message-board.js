define(function () {
	const MessageBoard = {
		load: function () {
			new Vue({
			    el: '#message-board',
			    data: {
		    		$messages: null,
		    		$el: null,
		    		state: {
		    			active: true
		    		}
			    },
			    
			    methods: {
			    	initialize: function () {
			    		this.$el = $(this.$el);
			    		this.$messages = this.$el.find('.user-message');

			    		var self = this;

			    		_.each(this.$messages, $.proxy(function (message) {
			    			var $message = $(message);
			    			var $sender = $message.find('.sender').first();

			    			$sender.click($.proxy(function (event) {
			    				event.preventDefault();
			    				
			    				$message.toggleClass('active');
			    				
			    			}, this));

			    		}, this));
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    }
			});
		}
	};
	
	return MessageBoard;
});




