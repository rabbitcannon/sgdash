<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin() {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('login_email', 'anesthetikal@gmail.com')
                ->type('login_password', 'testpass')
                ->press('@loginBtn')
                ->assertPathIs('/admin');
        });
    }
}
