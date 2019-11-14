// Application bootstrap
require('./bootstrap');

// Bootstrap library
require('bootstrap');

var StoreNavigation = require('./profile-navigation');

var $ = window.$;

$(document).ready(function () {
	StoreNavigation.load();
});




