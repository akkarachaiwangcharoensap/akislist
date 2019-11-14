// Application bootstrap
require('../../bootstrap');

// Bootstrap library
require('bootstrap');

var AdminNavigation = require('../admin-navigation');

var $ = window.$;

$(document).ready(function () {
	AdminNavigation.load();
});
