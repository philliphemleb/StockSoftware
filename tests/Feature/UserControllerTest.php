<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class UserControllerTest
 * @covers UserController
 * @package Tests\Feature
 */
class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserControllerShouldRedirectToLoginPageIfUserIsNotLoggedIn()
    {
        $this->followingRedirects()->get('/user')->assertViewIs('auth.login');
    }

    public function testIndex()
    {
        $user = $this->login();

        $this->followingRedirects()->get('/user')
            ->assertViewIs('user.index')
            ->assertSee('Willkommen')
            ->assertSee($user->name)
            ->assertSee('Persönliche Account Übersicht')
            ->assertSee('Account bearbeiten');
    }

    public function testEdit()
    {
        $user = $this->login();

        $this->followingRedirects()->get('/user/' . $user->id . '/edit')
            ->assertViewIs('user.edit')
            ->assertSee('Namen bearbeiten')
            ->assertSee($user->name)
            ->assertSee('Email bearbeiten')
            ->assertSee($user->email)
            ->assertSee('Passwort bearbeiten')
            ->assertSee('Leer lassen falls keine Änderung')
            ->assertSee('Aktuelles Passwort')
            ->assertSee('Bei Passwortänderung aktuelles Passwort eingeben');
    }

    public function testUpdate()
    {
        $user = $this->login();
        $newUser = factory(User::class)->make();

        $data = [
            'name' => $user->name,
            'email' => $newUser->email,
            'password' => 'IAmAGoodPassword',
            'actualPassword' => 'password'
        ];

        $this->followingRedirects()->put('/user/' . $user->id, $data)
            ->assertViewIs('user.index')
            ->assertSee('Bearbeitung erfolgreich');
    }

    public function testUpdateRedirectsToEditIfActualPasswordDoesNotMatch()
    {
        $user = $this->login();
        $newUser = factory(User::class)->make();

        $data = [
            'name' => $user->name,
            'email' => $newUser->email,
            'password' => 'IAmAGoodPassword',
            'actualPassword' => 'WrongPassword'
        ];

        $this->followingRedirects()->put('/user/' . $user->id, $data)
            ->assertViewIs('user.edit')
            ->assertSee('Das aktuelle Passwort stimmt nicht überein');
    }
}
