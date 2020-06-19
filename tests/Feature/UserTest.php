<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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
            ->assertSee($user->name)
            ->assertSee(__('user.change_account_data'));
    }

    public function testEdit()
    {
        $user = $this->login();

        $this->followingRedirects()->get('/user/' . $user->id . '/edit')
            ->assertViewIs('user.edit')
            ->assertSee(__('user.edit_name'))
            ->assertSee($user->name)
            ->assertSee(__('user.edit_email'))
            ->assertSee($user->email)
            ->assertSee(__('user.edit_password'))
            ->assertSee('Leer lassen falls keine Änderung')
            ->assertSee(__('user.actual_password'))
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
