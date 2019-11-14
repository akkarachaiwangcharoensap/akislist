<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilePagesTest extends DuskTestCase
{
    /**
     * @group ProfilePagesTest
     * Test profile page
     * @return void
     */
    public function testProfilePage ()
    {
        $this->browse(function (Browser $browser) {
        	$this->login($browser)
        		->assertSee('AkisList')
        		->assertPathIs('/profile');
        });
    }

    /**
     * @group ProfilePagesTest
     * Test profile confirmation page
     * @return void
     */
    public function testProfileConfirmationPage ()
    {
    	// Make sure testProfilePage runs before this.
    	$this->browse(function (Browser $browser) {
    		$browser->visit('/profile/confirmation')
    			// if confirmed should redirect to profile
    			->assertSee('AkisList')
    			->assertPathIs('/profile');
    	});
    }

    /**
     * @group ProfilePagesTest
     * Test profile edit page
     * @return void
     */
    public function testProfileEditPage ()
    {
    	$this->browse(function (Browser $browser) {
    		$browser->visit('/profile/edit')
    			->assertSee('AkisList')
    			->assertPathIs('/profile/edit');
    	});
    }

    /**
     * @group ProfilePagesTest
     * Test profile messages page
     * @return void
     */
    public function testProfileMessagesPage ()
    {
    	$this->browse(function (Browser $browser) {
    		$browser->visit('/profile/messages')
    			->assertSee('AkisList')
    			->assertPathIs('/profile/messages');
    	});
    }

    /**
     * @group ProfilePagesTest
     * Test profile settings page
     * @return void
     */
    public function testProfileSettingsPage ()
    {
    	$this->browse(function (Browser $browser) {
    		$browser->visit('/profile/settings')
    			->assertSee('AkisList')
    			->assertPathIs('/profile/settings');
    	});
    }

    /**
     * @group ProfilePagesTest
     * Test profile store page
     * @return void
     */
    public function testProfileStorePage ()
    {
    	$this->browse(function (Browser $browser) {
    		$browser->visit('/profile/store')
    			->assertSee('AkisList')
    			->assertPathIs('/profile/store');
    	});
    }

    /**
     * @group ProfilePagesTest
     * Test profile store new page
     * @return void
     */
    public function testProfileStoreNewPage ()
    {
    	$this->browse(function (Browser $browser) {
    		$browser->visit('/profile/store/new')
    			->assertSee('AkisList')
    			->assertPathIs('/profile/store/new');
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
