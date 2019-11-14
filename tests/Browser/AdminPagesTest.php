<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPagesTest extends DuskTestCase
{
    /**
     * @group AdminPagesTest
     * Test admin page
     * @return void
     */
    public function testAdminPage ()
    {
        $this->browse(function (Browser $browser) {
        	$this->login($browser)
        		->visit('/admin')
        		->assertSee('AkisList')
        		->assertPathIs('/admin');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin news page
     * @return void
     */
    public function testAdminNewsPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/news')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/news');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin news new page
     * @return void
     */
    public function testAdminNewsNewPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/news/new')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/news/new');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin pages page
     * @return void
     */
    public function testAdminPagesPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/pages')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/pages');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin pages new page
     * @return void
     */
    public function testAdminPagesNewPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/pages/new')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/pages/new');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin store reported page
     * @return void
     */
    public function testAdminStoreReportedPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/store/reported')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/store/reported');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin users reported page
     * @return void
     */
    public function testAdminUsersReportedPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/users/reported')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/users/reported');
        });
    }

    /**
     * @group AdminPagesTest
     * Test admin users details reported page
     * @return void
     */
    public function testAdminUsersReportedDetailsPage ()
    {
        $this->browse(function (Browser $browser) {
        	$browser->visit('/admin/users/reported/details')
        		->assertSee('AkisList')
        		->assertPathIs('/admin/users/reported/details');
        });
    }

    /**
     * Login to profile
     * @return Browser $browser
     */
    public function login(Browser $browser)
    {
        return $browser->visit('/profile')
            ->waitForLocation('/login')
            ->type('email', 'AkkarachaiWangcharoensap@gmail.com')
            ->type('password', 'test123')
            ->press('Login');
    }
}
