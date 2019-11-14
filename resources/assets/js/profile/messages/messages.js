// Application bootstrap
require('../../bootstrap');

// Bootstrap library
require('bootstrap');

var StoreNavigation = require('../../profile-navigation');
var SaleItem = require('../../store/sale-item');
var MessageBoard = require('./message-board');
var ReportModal = require('../../modals/report-modal');

var $ = window.$;
var _ = window._;

$(document).ready(function () {
	StoreNavigation.load();
	MessageBoard.load();
	ReportModal.load();
	
	var $saleItems = $('.sale-item');

	_.each($saleItems, function (saleItem) {
		var $saleItem = $(saleItem);
		var $gallery = $saleItem.find('.gallery').first();

		var id = '#'+$gallery.attr('id');

		SaleItem.load(id);
	});
});




