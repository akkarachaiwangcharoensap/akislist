// Application bootstrap
require('../../bootstrap');

// Bootstrap library
require('bootstrap');

var AdminNavigation = require('../admin-navigation');
var PageEditor = require('./page-editor');

var $ = window.$;

$(document).ready(function () {
	AdminNavigation.load();
	PageEditor.load();
});
