let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/home.js', 'public/js')
	.js('resources/assets/js/bootstrap.js', 'public/js');

/**
 * Pages CSS Compiling
 */
mix.sass('resources/assets/sass/home.scss', 'public/css')
	.sass('resources/assets/sass/contact-us.scss', 'public/css')
	.sass('resources/assets/sass/navigation.scss', 'public/css')
	.sass('resources/assets/sass/getting-started.scss', 'public/css')
	.sass('resources/assets/sass/store.scss', 'public/css')
	.sass('resources/assets/sass/privacy-policy.scss', 'public/css')
	.sass('resources/assets/sass/term-of-services.scss', 'public/css')
	.sass('resources/assets/sass/credits.scss', 'public/css')
	.sass('resources/assets/sass/footer.scss', 'public/css')
	.sass('resources/assets/sass/news.scss', 'public/css')
	.sass('resources/assets/sass/utility.scss', 'public/css');


/**
 * Profile pages
 * CSS Compiling
 */
mix.sass('resources/assets/sass/profile.scss', 'public/css')
	.sass('resources/assets/sass/profile/store.scss', 'public/css/profile')
	.sass('resources/assets/sass/profile/navigation.scss', 'public/css/profile')
	.sass('resources/assets/sass/profile/messages.scss', 'public/css/profile')
	.sass('resources/assets/sass/profile/message.scss', 'public/css/profile')
	.sass('resources/assets/sass/profile/edit.scss', 'public/css/profile')
	.sass('resources/assets/sass/profile/settings.scss', 'public/css/profile')
	.sass('resources/assets/sass/profile/confirmation.scss', 'public/css/profile');

/**
 * Store Sale Item
 * CSS Compiling
 */
mix.sass('resources/assets/sass/store/sale-item.scss', 'public/css/store')
	.sass('resources/assets/sass/store/select2-select.scss', 'public/css/store')
	.sass('resources/assets/sass/store/gallery.scss', 'public/css/store')
	.sass('resources/assets/sass/store/sale-item-gallery.scss', 'public/css/store')
	.sass('resources/assets/sass/store/store-navigation.scss', 'public/css/store')
	.sass('resources/assets/sass/store/sale-item-thumbnail.scss', 'public/css/store');

/**
 * Profile Store pages
 * CSS Compiling
 */
mix.sass('resources/assets/sass/profile/store/new.scss', 'public/css/profile/store')
	.sass('resources/assets/sass/profile/store/edit.scss', 'public/css/profile/store')
	.sass('resources/assets/sass/profile/store/preview.scss', 'public/css/profile/store')
	.sass('resources/assets/sass/profile/store/upload.scss', 'public/css/profile/store')
	.sass('resources/assets/sass/profile/store/finish.scss', 'public/css/profile/store');

/**
 * Profile store pages
 * JS Compiling
 */
mix.js('resources/assets/js/profile/store.js', 'public/js/profile')
	.js('resources/assets/js/profile/message.js', 'public/js/profile')
	.js('resources/assets/js/profile/settings.js', 'public/js/profile')
	.js('resources/assets/js/profile/edit.js', 'public/js/profile')
	.js('resources/assets/js/profile/store/edit.js', 'public/js/profile/store')
	.js('resources/assets/js/profile/store/new.js', 'public/js/profile/store')
	.js('resources/assets/js/profile/store/sale-item-editor.js', 'public/js/profile/store')
	.js('resources/assets/js/profile/store/upload.js', 'public/js/profile/store')
	.js('resources/assets/js/profile/store/image-uploader.js', 'public/js/profile/store')
	.js('resources/assets/js/profile/messages/messages.js', 'public/js/profile/messages')
	.js('resources/assets/js/profile/messages/message-board.js', 'public/js/profile/messages');

/**
 * Store Sale Item
 * JS Compiling
 */
mix.js('resources/assets/js/store/sale-item.js', 'public/js/profile/store');

/**
 * Author
 * CSS Compiling
 */
mix.sass('resources/assets/sass/auth/reset.scss', 'public/css/auth')
	.sass('resources/assets/sass/auth/email.scss', 'public/css/auth')
	.sass('resources/assets/auth/register.scss', 'public/css/auth')
	.sass('resources/assets/auth/login.scss', 'public/css/auth');

/**
 * Store pages
 * JS Compiling
 */
mix.js('resources/assets/js/profile.js', 'public/js')
	.js('resources/assets/js/store.js', 'public/js')
	.js('resources/assets/js/privacy-policy.js', 'public/js')
	.js('resources/assets/js/term-of-services.js', 'public/js')
	.js('resources/assets/js/credits.js', 'public/js')
	.js('resources/assets/js/profile-navigation.js', 'public/js')
	.js('resources/assets/js/store-navigation.js', 'public/js')
	.js('resources/assets/js/contact-us.js', 'public/js')
	.js('resources/assets/js/sale-item.js', 'public/js')
	.js('resources/assets/js/sale-item/map.js', 'public/js/sale-item');
	
mix.js('resources/assets/js/store/search-location-select.js', 'public/js/store')
	.js('resources/assets/js/store/search-category-select.js', 'public/js/store')
	.js('resources/assets/js/store/images-gallery.js', 'public/js/store');

/**
 * Profile Store
 * JS Compiling
 */
// mix.js('resources/assets/js/profile/store/preview.js', 'public/js/profile/store');

/**
 * Modal
 * JS Compiling
 */
mix.js('resources/assets/js/modals/report-modal.js', 'public/js/modals')
	.js('resources/assets/js/modals/user-contact-modal.js', 'public/js/modals');


/**
 * Modal
 * CSS Comiling
 */
mix.sass('resources/assets/sass/modals/report-modal.scss', 'public/css/modals')
	.sass('resources/assets/sass/modals/user-contact-modal.scss', 'public/css/modals')
	.sass('resources/assets/sass/modals/unauthorized-modal.scss', 'public/css/modals');

/**
 * Admin
 * CSS Compiling
 */
mix.sass('resources/assets/sass/admin/home.scss', 'public/css/admin')
	.sass('resources/assets/sass/admin/navigation.scss', 'public/css/admin')
	.sass('resources/assets/sass/admin/left-navigation.scss', 'public/css/admin')
	.sass('resources/assets/sass/admin/users/reported.scss', 'public/css/admin/users')
	.sass('resources/assets/sass/admin/users/reported-details.scss', 'public/css/admin/users')
	.sass('resources/assets/sass/admin/users/user.scss', 'public/css/admin/users')
	.sass('resources/assets/sass/admin/sale-items/reported-details.scss', 'public/css/admin/sale-items')
	.sass('resources/assets/sass/admin/pages/pages.scss', 'public/css/admin/pages')
	.sass('resources/assets/sass/admin/pages/page.scss', 'public/css/admin/pages')
	.sass('resources/assets/sass/admin/pages/new.scss', 'public/css/admin/pages')
	.sass('resources/assets/sass/admin/pages/edit.scss', 'public/css/admin/pages')
	.sass('resources/assets/sass/admin/news/news.scss', 'public/css/admin/news')
	.sass('resources/assets/sass/admin/news/post.scss', 'public/css/admin/news')
	.sass('resources/assets/sass/admin/news/edit.scss', 'public/css/admin/news')
	.sass('resources/assets/sass/admin/news/new.scss', 'public/css/admin/news');

/**
 * Admin
 * JS Compiling
 */
mix.js('resources/assets/js/admin/home.js', 'public/js/admin')
	.js('resources/assets/js/admin/user.js', 'public/js/admin')
	.js('resources/assets/js/admin/admin-navigation.js', 'public/js/admin')
	.js('resources/assets/js/admin/page/new.js', 'public/js/admin/page')
	.js('resources/assets/js/admin/news/news.js', 'public/js/admin/news');


if (mix.inProduction()) {
	mix.version();
}






