var tinymce = require('tinymce/tinymce');

// tinymce theme
require('tinymce/themes/modern/theme');

// tinymce plugin
require('tinymce/plugins/advlist/plugin');
require('tinymce/plugins/anchor/plugin');
require('tinymce/plugins/autolink/plugin');
require('tinymce/plugins/lists/plugin');
require('tinymce/plugins/link/plugin');
require('tinymce/plugins/image/plugin');
require('tinymce/plugins/charmap/plugin');
require('tinymce/plugins/print/plugin');
require('tinymce/plugins/preview/plugin');
require('tinymce/plugins/textcolor/plugin');
require('tinymce/plugins/visualblocks/plugin');
require('tinymce/plugins/code/plugin');
require('tinymce/plugins/fullscreen/plugin');
require('tinymce/plugins/media/plugin');
require('tinymce/plugins/contextmenu/plugin');
require('tinymce/plugins/paste/plugin');
require('tinymce/plugins/wordcount/plugin');
require('tinymce/plugins/colorpicker/plugin');
require('tinymce/plugins/hr/plugin');

define(function () {

	const SaleItemEditor = {
		load: function () {
			new Vue({
			    el: '#sale-item-editor',
			    data: {
			    	$el: null
			    },

			    methods: {

			    	/**
			    	 * Initialize map
			    	 * @return void
			    	 */
			    	initialize: function () {

			    		this.$el = $(this.el);

			    		tinymce.init({
			    			selector: '#sale-item-editor',
			    			height: 450,
			    			menubar: false,
			    			body_class: 'tinymce-editor',
			    			skin_url: '/css/profile/store/skins/lightgray',
			    			fontsize_formats: "8px 10px 12px 14px 16px 18pt 20px 22px 24px 32px 36px 42px 48px",
			    			plugins: [
							    'advlist autolink lists link image charmap print preview anchor textcolor',
							    'visualblocks code fullscreen hr',
							    'paste code wordcount colorpicker'
							],
							toolbar: 'undo redo |  formatselect | fontsizeselect | bold italic backcolor forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
							content_css: [
								'/css/admin/pages/new.css'
							]
			    		});
			    	},

			    },

			    mounted: function () {
			    	this.initialize ();
			   	}
			});
		}
	}

	return SaleItemEditor;

});
