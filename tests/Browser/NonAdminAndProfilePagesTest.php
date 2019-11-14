<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NonAdminAndProfilePagesTest extends DuskTestCase
{
    /**
     * @group NonAdminAndProfilePagesTest
     * Test home page
     * @return void
     */
    public function testHomePage ()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
            		->assertSee('AkisList')
                    ->assertPathIs('/');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test contact us page
     * @return void
     */
    public function testContactUsPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/contact-us')
            		->assertSee('AkisList')
                    ->assertPathIs('/contact-us');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test credits page
     * @return void
     */
    public function testCreditsPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/credits')
                    ->assertSee('AkisList')
                    ->assertPathIs('/credits');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test getting started page
     * @return void
     */
    public function testGettingStartedPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/getting-started')
                    ->assertSee('AkisList')
                    ->assertPathIs('/getting-started');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test login page
     * @return void
     */
    public function testLoginPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('AkisList')
                    ->assertPathIs('/login');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test news page
     * @return void
     */
    public function testNewsPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->assertSee('AkisList')
                    ->assertPathIs('/news');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test password reset page
     * @return void
     */
    public function testPasswordResetPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/password/reset')
                    ->assertSee('AkisList')
                    ->assertPathIs('/password/reset');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test register page
     * @return void
     */
    public function testRegisterPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('AkisList')
                    ->assertPathIs('/register');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test store page
     * @return void
     */
    public function testStorePage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/store')
                    ->assertSee('AkisList')
                    ->assertPathIs('/store');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test store search category page
     * @return void
     */
    public function testStoreCategoryPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/store/computers')
                    ->assertSee('AkisList')
                    ->assertPathIs('/store/computers');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test store search keyword page
     * @return void
     */
    public function testStoreKeywordPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/store/books/book')
                    ->assertSee('AkisList')
                    ->assertPathIs('/store/books/book');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test term of services page
     * @return void
     */
    public function testTermOfServicesPage ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/term-of-services')
                    ->assertSee('AkisList')
                    ->assertPathIs('/term-of-services');
        });
    }

    /**
     * @group NonAdminAndProfilePagesTest
     * Test piracy policy page
     * @return void
     */
    public function testPrivacyPolicy ()
    {
    	$this->browse(function (Browser $browser) {
            $browser->visit('/privacy-policy')
                    ->assertSee('AkisList')
                    ->assertPathIs('/privacy-policy');
        });
    }
}
