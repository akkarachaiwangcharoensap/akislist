// Application bootstrap
require('./bootstrap');

// Bootstrap library
require('bootstrap');

var StoreNavigation = require('./store-navigation');
var SearchCategorySelect = require('./store/search-category-select');
var SearchLocationSelect = require('./store/search-location-select');
var ReportModal = require('./modals/report-modal');
var SaleItem = require('./store/sale-item.js');

var $ = window.$;
var _ = window._;

$(document).ready(function () {
	StoreNavigation.load();
	
	SearchCategorySelect.load();
	SearchLocationSelect.load();

	ReportModal.load();

	var $saleItems = $('.sale-item');

	_.each($saleItems, function (saleItem) {
		var $saleItem = $(saleItem);
		var $gallery = $saleItem.find('.gallery').first();

		var id = '#'+$gallery.attr('id');

		SaleItem.load(id);
	});
});




