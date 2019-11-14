<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home page
Route::get('/', 'HomeController@index')
	->name('home')
	->middleware('check_new_sale_item_messages');

// route: /getting-started
Route::get('/getting-started', 'HomeController@showGettingStarted')
	->name('getting_started')
	->middleware('check_new_sale_item_messages');

// route: /contact-us
Route::get('/contact-us', 'ContactUsController@index')
	->name('contact-us')
	->middleware('check_new_sale_item_messages');

// route; /contact-us/send
Route::post('/contact-us/send', 'ContactUsController@send')
	->name('contact-us.send')
	->middleware('check_new_sale_item_messages');

// route: /privacy-policy
Route::get('/privacy-policy', 'PrivacyPolicyController@index')
	->name('privacy-policy')
	->middleware('check_new_sale_item_messages');

// route: /term-of-services
Route::get('term-of-services', 'TermOfServicesController@index')
	->name('term-of-services')
	->middleware('check_new_sale_item_messages');

// route: /credits
Route::get('credits', 'HomeController@showCredits')
	->name('credits')
	->middleware('check_new_sale_item_messages');

// route: /news
Route::get('/news', 'HomeController@showNews')
	->name('news')
	->middleware('check_new_sale_item_messages');

/**
 * Store Pages
 * Prefix: /store/
 */
Route::group(
	array(
		'prefix' => 'store',
		'middleware' => array('web', 'check_new_sale_item_messages')
	),
	function () {

		// route: /store
		Route::get('/', 'StoreController@index')
			->name('store');

		// route: /store/{category}
		Route::get('/{category}', 'StoreController@showSearchCategory')
			->name('store.search.category');

		// route: /store/{category}/{keyword}
		Route::get('/{category}/{keyword}/', 'StoreController@showSearchKeyword')
			->name('store.search.keyword');

		// route: /store/search
		Route::post('/search', 'StoreController@search')
			->name('store.search');

		// route: /search/show
		Route::post('/search/show', 'StoreController@showSearch')
			->name('store.search.show');

		// route: /store/{category}/{saleItem}/{uniqueString}
		Route::get('/{category}/{saleItem}/{uniqueString}', 'StoreController@showSaleItem')
			->name('store.sale-item.show');
			
		// route: /store/{category}/{saleItem}/{uniqueString}/report
		Route::post('/{category}/{saleItem}/{uniqueString}/report', 'StoreController@report')
			->name('store.sale-item.report');
	}
);

/**
 * Admin routes
 * Prefix: /admin
 */
Route::group(
	array(
		'prefix' => 'admin',
		'middleware' => array('web', 'check_admin_user')
	),
	function () {

		// route: /admin
		Route::get('/', 'Admin\AdminController@index')
			->name('admin');

		// route: admin/users/reported
		Route::get('/users/reported', 'Admin\AdminController@showUsersReported')
			->name('admin.users.reported');

		// route: admin/users/reported/details
		Route::get('/users/reported/details', 'Admin\AdminController@showUsersReportedDetails')
			->name('admin.users.reported.details');

		// route: admin/users/{name}/{uniqueString}
		Route::get('/users/{name}/{uniqueString}', 'Admin\AdminController@showUser')
			->name('admin.users.user');

		// route: admin/users/{name}/{uniqueString}/deactivate
		Route::post('/users/{name}/{uniqueString}/deactivate', 'Admin\AdminController@deactivate')
			->name('admin.users.user.deactivate');

		// route: admin/users/{name}/{uniqueString}/criminalize
		Route::post('/users/{name}/{uniqueString}/criminalize', 'Admin\AdminController@criminalize')
			->name('admin.users.user.criminalize');

		// route: admin/store/reported
		Route::get('/store/reported', 'Admin\StoreController@index')
			->name('admin.store.reported');

		// route: admin/store/{name}/{uniqueString}/deactivate
		Route::post('/store/{name}/{uniqueString}/deactivate', 'Admin\StoreController@deactivate')
			->name('admin.store.deactivate');

		/**
		 * Admin pages
		 * Prefix: pages
		 */
		Route::group(
			array(
				'prefix' => 'pages'
			), 
			function () {

				// route: admin/pages
				Route::get('/', 'Admin\PageController@index')
					->name('admin.pages');

				// route: admin/pages/new
				Route::get('/new', 'Admin\PageController@showNew')
					->name('admin.pages.new');

				// route: admin/pages/{id}
				Route::get('/{id}', 'Admin\PageController@showPage')
					->name('admin.pages.page')
					->where(['page' => '[0-9]+']);

				// route: admin/pages/{id}/edit
				Route::get('/{id}/edit', 'Admin\PageController@showEdit')
					->name('admin.pages.page.edit')
					->where(['page' => '[0-9]+']);

				// route: admin/pages/add
				Route::post('/add', 'Admin\PageController@add')
					->name('admin.pages.add');

				// route: admin/pages/{id}/save
				Route::post('/{id}/save', 'Admin\PageController@save')
					->name('admin.pages.page.save')
					->where(['page' => '[0-9]+']);

				// route: admin/pages/{id}/delete
				Route::delete('/{id}/delete', 'Admin\PageController@delete')
					->name('admin.pages.page.delete')
					->where(['page' => '[0-9]+']);
			}
		);

		// Admin News
		// Prefix: news
		Route::group(
			array(
				'prefix' => 'news'
			),
			function () {

				// route: admin/news
				Route::get('/', 'Admin\NewsController@index')
					->name('admin.news');

				// route: /admin/news/new
				Route::get('/new', 'Admin\NewsController@showNew')
					->name('admin.news.new');

				// route: admin/news/{id}
				Route::get('/{id}', 'Admin\NewsController@showPost')
					->name('admin.news.post')
					->where(['id' => '[0-9]+']);

				// route: admin/news/{id}
				Route::get('/{id}/edit', 'Admin\NewsController@showEdit')
					->name('admin.news.post.edit')
					->where(['id' => '[0-9]+']);

				// route: admin/news/add
				Route::post('/add', 'Admin\NewsController@add')
					->name('admin.news.add');

				// route: admin/news/{id}/save
				Route::post('/{id}/save', 'Admin\NewsController@save')
					->name('admin.news.post.save')
					->where(['id' => '[0-9]+']);

				// route: admin/news/{id}/delete
				Route::delete('/{id}/delete', 'Admin\NewsController@delete')
					->name('admin.news.post.delete')
					->where(['id' => '[0-9]+']);
			}
		);

	}
);

/**
 * Profile Pages
 * Prefix: /profile/
 */
Route::group(
	array(
		'prefix' => 'profile',
		'middleware' => array('auth', 'check_active_user', 'check_new_sale_item_messages')
	),
	function () {
		// route: /profile/
		Route::get('/', 'ProfileController@index')
			->name('profile');

		// route: /profile/edit
		Route::get('/edit', 'ProfileController@showEdit')
			->name('profile.edit');

		// prefix: /profile/messages
		Route::group(
			array(
				'prefix' => 'messages'
			), 
			function () {
				// route: /profile/messages
				Route::get('/', 'UserMessageController@index')
					->name('profile.messages');

				// route: /profile/messages/message/send
				Route::post('/message/send', 'UserMessageController@sendMessage')
					->name('profile.messages.message.send');

				// route: /profile/messages/message/delete
				Route::delete('/message/delete', 'UserMessageController@delete')
					->name('profile.messages.message.delete');
			}
		);

		// route: /profile/settings
		Route::get('/settings', 'ProfileController@showSettings')
			->name('profile.settings');

		// route: /profile/confirmation/{token}
		Route::get('/confirmation/{token}', 'ProfileController@confirm')
			->name('profile.confirmation');

		// route: /profile/confirmation
		Route::get('/confirmation', 'ProfileController@showConfirmation')
			->name('profile.confirmation.show');

		// route: /profile/save
		Route::post('/edit/save', 'ProfileController@save')
			->name('profile.save');

		// route: /profile/deactivate
		Route::post('/deactivate', 'ProfileController@deactivate')
			->name('profile.deactivate');

		// route: /profile/delete
		Route::post('/delete', 'ProfileController@delete')
			->name('profile.delete');

		// route: /profile/confirmation/resend
		Route::post('/confirmation/resend', 'ProfileController@resendConfirmation')
			->name('profile.confirmation.resend');

		// route: /profile/{uniqueString}/report
		Route::post('{uniqueString}/report', 'ProfileController@report')
			->name('profile.report');
		/**
		 * Profile Store Pages
		 * Prefix: /profile/store
		 */
		Route::group(
			array(
				'prefix' => 'store'
			),
			function() {

				// route: /profile/store
				Route::get('/', 'Profile\StoreController@index')
					->name('profile.store');

				// route: /profile/store/new
				Route::get('/new', 'Profile\StoreController@showNew')
					->name('profile.store.new');

				// route: /profile/store/{name}/edit/{random}
				Route::get('/{name}/edit/{random}', 'Profile\StoreController@showEdit')
					->name('profile.store.sale-item.edit');

				// route: /profile/store/{name}/upload/{random}
				Route::get('/{name}/upload/{random}', 'Profile\StoreController@showUpload')
					->name('profile.store.sale-item.upload');

				// route: /profile/store/{name}/finish/{random}
				Route::get('/{name}/finish/{random}', 'Profile\StoreController@showFinish')
					->name('profile.store.sale-item.finish');

				// route: /profile/store/{name}/preview/{random}
				Route::get('/{name}/preview/{random}', 'Profile\StoreController@showPreview')
					->name('profile.store.sale-item.preview');

				// route: /profile/store/new/add
				Route::post('/add', 'Profile\StoreController@add')
					->name('profile.store.add');

				// route: /profile/store/{name}/save/{random}
				Route::post('/{name}/save/{random}', 'Profile\StoreController@save')
					->name('profile.store.save');

				// route: /profile/store/{name}/post/{random}
				Route::post('/{name}/post/{random}', 'Profile\StoreController@post')
					->name('profile.store.post');

				// route: /profile/store/{sale-item}/delete
				Route::delete('/{name}/delete/{random}', 'Profile\StoreController@delete')
					->name('profile.store.sale-item.delete');
			}
		);
	}
);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')
	->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')
	->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')
	->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Geolocation
// Route::post('request/geolocation', 'GeoLocationController@index')
// 	->name('request.geolocation');

Route::post('request/geolocation/similar', 'GeoLocationController@similar')
	->name('request.geolocation.similar');

// Upload
// route: /request/{random}/upload/image
Route::post('request/{random}/upload/image', 'UploadController@uploadImage')
	->name('request.upload.image');

// Files
Route::get('files/{folder}/{name}', 'FileController@get')
	->name('request.files.file.get');

Route::delete('files/{folder}/{name}/delete', 'FileController@delete')
	->name('request.files.file.delete');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
	->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
	->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
	->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');










