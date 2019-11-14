define(function () {
	const ImageUploader = {
		load: function () {
			new Vue({
			    el: '#images-upload',
			    data: {
			    	$parent: null,
			    	$files: null,
			    	$dump: null,
			    	data: null,
			    	uploads: [],
			    	max: 10,
			    },

			    methods: {

			    	/**
			    	 * Initialize images-upload
			    	 * @return void
			    	 */
			    	initialize: function () {

			    		this.$parent = $(this.$el).parent();
			    		this.$files = this.$parent.find('.files');
			    		this.$dump = $('#json-dump');

			    		this.data = JSON.parse(this.$dump.val());

			    		$(this.$el).on('dragover', $.proxy(this.onDrag, this));
			    		$(this.$el).on('drop', $.proxy(this.onDrop, this));

			    		// $(this.$el).on('drop', $.proxy(this.onDrop, this));
			    		this.onWindowListeners ();

			    		// Initialize uploaded files
			    		this.initializeUploadedFiles ();
			    		this.registerFilesListeners ();
			    	},

			    	/**
			    	 * Deconstruct
			    	 * @return void
			    	 */
			    	deconstruct: function () {
			    		this.$dump.remove();
			    	},

			    	/**
			    	 * On file dragging
			    	 *
			    	 * @param EventData event
			    	 * @return void
			    	 */
			    	onDrag: function (event) {
			    		event.preventDefault ();
			    	},

			    	/**
			    	 * On file dropped onto the uploader
			    	 *
			    	 * @param EventData event
			    	 * @return void
			    	 */
			    	onDrop: function (event) {
			    		event.preventDefault ();

						var items = event.originalEvent.dataTransfer.items;
		    			
		    			if (items) {

		    				var allowExtensions = ['image/jpg','image/png', 'image/jpeg'];
		    				var files = new FormData();

		    				var allow = true;
		    				var isMax = false;

		    				_.each(items, $.proxy(function (item, index) {

		    					var file = item.getAsFile ();
								
								// verify file's type
		    					if (this.isAllowed(file) == false) {
		    						allow = false;
		    						return;
		    					}

		    					if (this.uploads.length + 1 > this.max) {
		    						isMax = true;
		    						return;
		    					}

		    					files.append('files['+index+']', file);

		    					var success = {
		    						'message': 'Uploading...'
		    					};

		    					this.outputSuccess (success);
		    				}, this));

		    				var error = {
		    					message: 'Please verify your file(s).',
		    					size: '24 MB',
		    					allows: ['jpg', 'jpeg', 'png']
		    				};

		    				if (isMax) {

	    						var success = {
	    							'message': 'You are limited to ' + this.max + ' uploads per post.'
	    						};

	    						this.outputSuccess (success);
	    						return;
		    				}

		    				if (!allow) {
		    					this.outputError (error);
		    					return;
		    				}

							this.upload(files);
		    			}

			    	},

			    	/**
			    	 * Output error messages
			    	 *
			    	 * @param object error
			    	 * @return void
			    	 */
			    	outputError: function (error) {
			    		var allows = 'Allow extension(s): ' + error.allows.join(', ');

			    		var errorOutput = error.message + ' ' + allows + ', ' + 'max size: ' + error.size;

			    		var $template = this.errorTemplate (errorOutput);
			    		var $message = this.$parent.find('.status .message');

			    		$message.empty();
			    		$message.append($template);
			    	},

			    	/**
			    	 * Output success success
			    	 *
			    	 * @param object success
			    	 * @return void
			    	 */
			    	outputSuccess: function (success) {
			    		var $template = this.successTemplate (success.message);
			    		var $message = this.$parent.find('.status .message');

			    		$message.empty();
			    		$message.append($template);
			    	},

			    	/**
			    	 * Error template
			    	 *
			    	 * @param string message
			    	 * @return string
			    	 */
			    	errorTemplate: function (message) {
			    		return '<p class="error">'
					    			+ message
					    		+'</p>';
			    	},

			    	/**
			    	 * Success template
			    	 *
			    	 * @param string message
			    	 * @return string
			    	 */
			    	successTemplate: function (message) {
			    		return '<p class="success">'
			    					+ message
			    				+ '</p>';
			    	},

			    	/**
			    	 * Upload files
			    	 * 
			    	 * @param FormData files
			    	 * @return bool
			    	 */
			    	upload: function (files) {

			    		$.ajax ({
			    			context: this,
			    			url: '/request/'+ this.data.random +'/upload/image',
			    			headers: {
			    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    			},
			    			method: 'POST',
			    			dataType: 'json',
			    			data: files,
			    			processData: false,
			   				contentType: false,
			    			cache: false,

			    			success: function (response) {

			    				// Error
			    				if (response.error) {
			    					this.outputError(response.error);
			    				} 
			    				// Success
			    				else {
			    					var index = this.uploads.length;
			    					$fileTemplate = $(this.fileTemplate(response.success.image, index));
			    						
			    					var uploadFile = {
			    						el:  $fileTemplate,
			    						data: response.success
			    					};

			    					// push file to uploads
			    					this.uploads.push(uploadFile);
			    					
			    					this.$files.append($fileTemplate);
			    					this.registerFileListeners($fileTemplate);

			    					this.outputSuccess(response.success);
			    				}
			    			},

			    			error: function (jqXHR, status, error) {
			    				console.error(jqXHR);
			    				console.error(status);
			    				console.error(error);
			    			}
			    		});
			    	},

			    	/**
			    	 * Initialize uploaded files
			    	 *
			    	 */
			    	initializeUploadedFiles: function () {
			    		
			    		_.each(this.$files.children(), $.proxy(function (file) {
			    			var $file = $(file);

			    			var data = {
			    				image: $file.find('img').attr('src'),
			    			};

			    			var uploadedFile = {
			    				el: $file,
			    				data: data
			    			};

			    			this.uploads.push(uploadedFile);
			    		}, this));

			    	},

			    	/**
			    	 * File template
			    	 *
			    	 * @param imageSource
			    	 * @param int index
			    	 *
			    	 * @return string
			    	 */
			    	fileTemplate: function (imageSource, index) {
						return '<div class="file" data-index="'+ index +'">'
									+ '<div class="fa fa-times remove"></div>'
									+ '<img src="'+ imageSource +'"/>'
								+ '</div>';
			    	},

			    	/**
			    	 * Register individual file event listeners
			    	 * @return void
			    	 */
			    	registerFileListeners: function ($file) {
			    		$remove = $file.find('.remove').first();
			    		
			    		$remove.on('click', $.proxy(function () {
			    			this.remove($file);
			    		}, this));
			    	},

			    	/**
			    	 * Remove uploaded file
			    	 *
			    	 * @param $file
			    	 * @return void
			    	 */
			    	remove: function ($file) {
						var data = $file.data();
			    		var file = this.uploads[data.index];
			    		
			    		var image = file.data.image;

			    		$file.remove ();

			    		$.ajax({
			    			context: this,
			    			headers: {
			    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    			},
			    			dataType: 'json',
			    			url: image + '/delete',
			    			type: 'DELETE',
			    			
			    			success: function (response) {

			    				// If response is true
			    				if (response) {
									// Remove an element at index
				    				this.uploads.splice(data.index, 1);
				    			}
			    			},

			    			error: function (xhr, status, error) {
			    				console.error (xhr);
			    				console.error (status);
			    				console.error (error);
			    			}
			    		});
			    	},

			    	/**
			    	 * Register file event listeners
			    	 * @return void
			    	 */
			    	registerFilesListeners: function () {
			    		_.each(this.$files.children(), $.proxy(function (file) {
			    			
			    			var $file = $(file);
			    			this.registerFileListeners ($file);

			    		}, this));
			    	},

			    	/**
			    	 * Is file extension allowed
			    	 *
			    	 * @param File file
			    	 * @return bool
			    	 */
			    	isAllowed: function (file) {
			    		var extensions = ['image/jpeg', 'image/png', 'image/jpeg'];
			    		var maxSize = 25165824; // 24 MB

			    		var allow = false;
			    		_.each (extensions, function (extension) {
			    			if (file.type == extension && file.size < maxSize) {
			    				allow = true;
			    				return;
			    			}
			    		});
			    		
			    		return allow;
			    	},

			    	/**
			    	 * Window event listeners
			    	 * @return void
			    	 */
			    	onWindowListeners: function () {

			    		$(window).on('dragover', function (event) {
			    			event.preventDefault ();
			    		});

			    		$(window).on('drop', function (event) {
			    			event.preventDefault ();
			    		});

			    	}
			    },

			    mounted: function () {
			    	this.initialize ();
			    }
			});
		}
	}

	return ImageUploader;

});
