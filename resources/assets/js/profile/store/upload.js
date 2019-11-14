// Application bootstrap
require('../../bootstrap');

// Bootstrap library
require('bootstrap');

var ProfileNavigation = require('../../profile-navigation');
var ImageUploader = require('./image-uploader');

var $ = window.$;

$(document).ready(function () {
	ProfileNavigation.load();
	ImageUploader.load();
});




