// Application bootstrap
require('../bootstrap');

// Bootstrap library
require('bootstrap');

var StoreNavigation = require('../profile-navigation');
var ReportModal = require('../modals/report-modal');

var $ = window.$;

$(document).ready(function () {
	StoreNavigation.load();
	ReportModal.load();
});




