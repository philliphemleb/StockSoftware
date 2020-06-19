<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login(): User
    {
        return tap(factory(User::class)->create(), fn($user) => $this->actingAs($user));
    }
}
