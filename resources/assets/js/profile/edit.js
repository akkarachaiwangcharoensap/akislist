// Application bootstrap
require('../bootstrap');

// Bootstrap library
require('bootstrap');

var ProfileNavigation = require('../profile-navigation');

var $ = window.$;

$(document).ready(function () {
	ProfileNavigation.load();
});




