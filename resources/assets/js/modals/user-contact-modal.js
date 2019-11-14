define(function () {
	const UserContactModal = {
		load: function () {
			new Vue({
			    el: '#user-contact-modal',
			    data: {
			    	url: null,
			    	$dump: null,
			    	$unauthorizedModal: null,
			    	loggedIn: false,
			    },

			    methods: {
			    	initialize: function () {

			    		this.$dump = $('#json-dump');
			    		this.$unauthorizedModal = $('#unauthorized-modal');

			    		this.loggedIn = JSON.parse(this.$dump.val()).loggedIn;

			    		$contacts = $('.contact');

			    		var self = this;

			    		_.each($contacts, function (contact) {
			    			var $contact = $(contact);
			    			
			    			$contact.click(function (event) {
			    				event.preventDefault ();

			    				if (!self.loggedIn) {
			    					self.$unauthorizedModal.modal('show');
			    					return;
			    				}

								$(self.$el).modal('show');
			    			});
			    		});
			    	},

			    	deconstruct: function () {
			    		this.$dump.remove();
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    }
			});
		}
	};

	return UserContactModal;
});


