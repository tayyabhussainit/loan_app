<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * This test case will test register api happy scenario
     */
    public function test_register(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;

        $response = $this->registerUser($name, $email, $password, $password);

        $this->assertEquals($response['success'], true);
    }

    /**
     * This test case will test login api happy scenario
     */
    public function test_login(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;

        $this->registerUser($name, $email, $password, $password);
        $response = $this->loginUser($email, $password);

        $this->assertEquals($response['success'], true);
    }

    /**
     * This test case will test login api happy scenario
     */
    public function test_loginWrongEmail(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;

        $this->registerUser($name, $email, $password, $password);
        $email = fake()->email;
        $response = $this->loginUser($email, $password);

        $this->assertEquals($response['success'], false);
    }

    /**
     * This test case will test login api happy scenario
     */
    public function test_loginWrongPassword(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;

        $this->registerUser($name, $email, $password, $password);
        $password = fake()->password;
        $response = $this->loginUser($email, $password);

        $this->assertEquals($response['success'], false);
    }

    /**
     * This test case will test complete auth process via api as happy scenario
     */
    public function test_auth(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;

        $this->registerUser($name, $email, $password, $password);
        $login = $this->loginUser($email, $password);

        $this->assertEquals($login['success'], true);
    }

    /**
     * This test case will test the login api with faker credentials
     */
    public function test_loginApiValidation(): void
    {
        $email = fake()->email;
        $password = fake()->password();
        $login = $this->loginUser($email, $password);

        $this->assertEquals($login['success'], false);
    }
}
