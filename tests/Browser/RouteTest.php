<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteTest extends DuskTestCase
{

    /**
     *
     */
    public function testRootPath() {
        $response = $this->get('/');
        //A 302 is expected because you should be redirected to /login if you hit the root URL and not logged in.
        $response->assertStatus(302);
    }

    /**
     *
     */
    public function testLoginPath() {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
