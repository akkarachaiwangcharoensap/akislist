// Application bootstrap
require('../bootstrap');

// Bootstrap library
require('bootstrap');

var ProfileNavigation = require('../profile-navigation');
var SaleItem = require('../store/sale-item');

var $ = window.$;
var _ = window._;

$(document).ready(function () {
	ProfileNavigation.load();

	var $saleItems = $('.sale-item');

	_.each($saleItems, function (saleItem) {
		var $saleItem = $(saleItem);
		var $gallery = $saleItem.find('.gallery').first();

		var id = '#'+$gallery.attr('id');

		SaleItem.load(id);
	});
});




