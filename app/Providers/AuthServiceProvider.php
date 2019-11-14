<?php

namespace App\Providers;

use App\User;
use App\News;

use App\Policies\UserPolicy;
use App\Policies\UserMessagePolicy;
use App\Policies\UserContactPolicy;
use App\Policies\UserSaleItemPolicy;

use App\Policies\NewsPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // User::class => UserPolicy::class,
        // User::class => UserStorePolicy::class,
        // User::class => UserSaleItemPolicy::class,
        // Page::class => PagePolicy::class,
        // News::class => NewsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // User messages gates
        Gate::define('user.message.send', 'App\Policies\UserMessagePolicy@send');
        Gate::define('user.message.view', 'App\Policies\UserMessagePolicy@view');
        Gate::define('user.message.delete', 'App\Policies\UserMessagePolicy@delete');

        // User contacts gates
        Gate::define('user.contact.delete', 'App\Policies\UserContactPolicy@delete');
        
        // User admin gates
        Gate::define('user.admin.deactivate', 'App\Policies\UserPolicy@deactivate');
        Gate::define('user.admin.criminalize', 'App\Policies\UserPolicy@criminalize');

        // User admin saleItem gates
        Gate::define('user.admin.saleItem.deactivate', 'App\Policies\AdminUserSaleItemPolicy@deactivate');

        // User admin pages gates
        Gate::define('user.admin.page.view', 'App\Policies\PagePolicy@view');
        Gate::define('user.admin.page.add', 'App\Policies\PagePolicy@add');
        Gate::define('user.admin.page.update', 'App\Policies\PagePolicy@update');
        Gate::define('user.admin.page.delete', 'App\Policies\PagePolicy@delete');

        // User admin news posts gates
        Gate::define('user.admin.news.view', 'App\Policies\NewsPolicy@view');
        Gate::define('user.admin.news.add', 'App\Policies\NewsPolicy@add');
        Gate::define('user.admin.news.update', 'App\Policies\NewsPolicy@update');
        Gate::define('user.admin.news.delete', 'App\Policies\NewsPolicy@delete');

        // User sale item post gates
        Gate::define('user.sale-item.edit', 'App\Policies\UserSaleItemPolicy@edit');
        Gate::define('user.sale-item.save', 'App\Policies\UserSaleItemPolicy@save');
        Gate::define('user.sale-item.delete', 'App\Policies\UserSaleItemPolicy@delete');
        Gate::define('user.sale-item.preview', 'App\Policies\UserSaleItemPolicy@preview');
        Gate::define('user.sale-item.post', 'App\Policies\UserSaleItemPolicy@post');
        Gate::define('user.sale-item.report', 'App\Policies\UserSaleItemPolicy@report');
    }
}
