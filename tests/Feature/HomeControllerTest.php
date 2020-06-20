<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class HomeControllerTest
 * @covers \App\Http\Controllers\HomeController
 * @package Tests\Feature
 */
class HomeControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testHomeControllerShouldRedirectToLoginPageIfUserIsNotLoggedIn()
    {
        $this->followingRedirects()->get('/')->assertViewIs('auth.login');
    }

    public function testIndex()
    {
        $user = $this->login();

        $this->followingRedirects()->get('/')
            ->assertViewIs('home')
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee('Willkommen')
            ->assertSee('Zu meinem Account')
            ->assertSee('Abmelden');
    }
}
