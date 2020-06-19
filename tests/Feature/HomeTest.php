<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
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
            ->assertSee(__('home.to_account'))
            ->assertSee(__('home.logout'));
    }
}
