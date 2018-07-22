<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
        $user = $user ?: factory(\App\User::class)->create();

        $this->user = $user;

        $this->actingAs($user);

        return $this;
    }
}
