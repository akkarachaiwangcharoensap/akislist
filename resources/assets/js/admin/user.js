// Application bootstrap
require('../bootstrap');

// Bootstrap library
require('bootstrap');

var AdminNavigation = require('../admin/admin-navigation');
var SaleItem = require('../store/sale-item.js');
var MessageBoard = require('../profile/messages/message-board');

var $ = window.$;
var _ = window._;

$(document).ready(function () {
	AdminNavigation.load();
	MessageBoard.load();

	var $saleItems = $('.sale-item');

	_.each($saleItems, function (saleItem) {
		var $saleItem = $(saleItem);
		var $gallery = $saleItem.find('.gallery').first();

		var id = '#'+$gallery.attr('id');

		SaleItem.load(id);
	});
});
