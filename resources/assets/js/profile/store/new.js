// Application bootstrap
require('../../bootstrap');

// Bootstrap library
require('bootstrap');

var ProfileNavigation = require('../../profile-navigation');
var SearchLocationSelect = require('../../store/search-location-select');
var SearchCategorySelect = require('../../store/search-category-select');
var SaleItemEditor = require('./sale-item-editor');

var $ = window.$;

$(document).ready(function () {
	ProfileNavigation.load();
	SearchLocationSelect.load();
	SearchCategorySelect.load();
	SaleItemEditor.load();
});




