<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
//    public function testCheckLoginPageExists() {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/login')->assertVisible('login-frame');
//        });
//    }

    /**
     *
     */
    public function testRootURL() {
        $response = $this->get('/');
        //A 302 is expected because you should be redirected to /login if you hit the root URL and not logged in.
        $response->assertStatus(302);
    }

    /**
     *
     */
//    public function testLoginPageToRoot() {
//        $this->browse(function($user) {
//            $user->loginAs(App\User::find(1))->visit('/login');
//        });
//    }
}
