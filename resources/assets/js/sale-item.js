// Application bootstrap
require('./bootstrap');

// Bootstrap library
require('bootstrap');

var UserContactModal = require('./modals/user-contact-modal');
var ReportModal = require('./modals/report-modal');
var SaleItemMap = require('./sale-item/map');
var ImagesGallery = require('./store/images-gallery');

var $ = window.$;

$(document).ready(function () {
	UserContactModal.load();
	SaleItemMap.load();
	ReportModal.load();
	ImagesGallery.load();
});




