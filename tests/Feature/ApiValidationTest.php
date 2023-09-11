<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * This class will be used to test the functionality of API validations
 */
class ApiValidationTest extends TestCase
{
    /**
     * This test case will test the login api validation
     * 
     * @missing input : email
     */
    public function test_loginApiValidationEmail(): void
    {
        $email = '';
        $password = fake()->password();
        $login = $this->loginUser($email, $password);

        $this->assertArrayHasKey('errors', $login);
        $this->assertArrayHasKey('email', $login['errors']);
    }

    /**
     * This test case will test the login api validation
     * 
     * @missing input : password
     */
    public function test_loginApiValidationPassword(): void
    {
        $email = fake()->email;
        $password = '';
        $login = $this->loginUser($email, $password);

        $this->assertArrayHasKey('errors', $login);
        $this->assertArrayHasKey('password', $login['errors']);
    }

    /**
     * This test case will test the register api validation
     * 
     * @missing input : name
     */
    public function test_registerApiValidationName(): void
    {
        $name = '';
        $email = fake()->email;
        $password = fake()->password();

        $register = $this->registerUser($name, $email, $password, $password);

        $this->assertArrayHasKey('errors', $register);
        $this->assertArrayHasKey('name', $register['errors']);
    }

    /**
     * This test case will test the register api validation
     * 
     * @missing input : email
     */
    public function test_registerApiValidationEmail(): void
    {
        $name = fake()->name;
        $email = '';
        $password = fake()->password();

        $register = $this->registerUser($name, $email, $password, $password);

        $this->assertArrayHasKey('errors', $register);
        $this->assertArrayHasKey('email', $register['errors']);
    }

    /**
     * This test case will test the register api validation
     * 
     * @missing input : confirm_password
     */
    public function test_registerApiValidationConfirmPassword(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;
        $confirmPassword = '';
        $register = $this->registerUser($name, $email, $password, $confirmPassword);

        $this->assertArrayHasKey('errors', $register);
        $this->assertArrayHasKey('confirm_password', $register['errors']);
    }

    /**
     * This test case will test the register api validation
     * 
     * @missing input : password
     */
    public function test_registerApiValidationPassword(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = '';

        $register = $this->registerUser($name, $email, $password, $password);

        $this->assertArrayHasKey('errors', $register);
        $this->assertArrayHasKey('password', $register['errors']);
    }

    /**
     * This test case will test the register api validation
     * 
     * mismatch password
     */
    public function test_registerApiValidationMismatchPassword(): void
    {
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;
        $confirmPassword = fake()->password;

        $register = $this->registerUser($name, $email, $password, $confirmPassword);

        $this->assertArrayHasKey('errors', $register);
        $this->assertArrayHasKey('confirm_password', $register['errors']);
    }
}
