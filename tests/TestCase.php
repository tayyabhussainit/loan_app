<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    protected function registerUser($email, $password): array
    {
        return $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/register', [
            'name' => fake()->name,
            'email' => $email,
            'password' => $password,
            'confirm_password' => $password
        ])->json();
    }

    protected function loginUser($email, $password): array
    {
        return $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', ['email' => $email, 'password' => $password])->json();
    }
}
