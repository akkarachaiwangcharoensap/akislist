define(function () {
	const ReportModal = {
		load: function () {
			new Vue({
			    el: '#report-modal',
			    data: {
			    	url: null,
			    },
			    methods: {
			    	initialize: function () {

			    		$reports = $('.report');

			    		var self = this;

			    		_.each($reports, function (report) {
			    			var $report = $(report);
			    			
			    			$report.click(function (event) {
			    				event.preventDefault ();

			    				self.url = $(this).data('sale-item');
			    				var $form = $(self.$el).find('#report-form');
			    				
			    				$form.attr('action', self.url);
			    				$(self.$el).modal('show');
			    			});
			    		});
			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    }
			});
		}
	};

	return ReportModal;
});


