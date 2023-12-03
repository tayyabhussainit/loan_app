<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_register(): void
    {   
        $email = fake()->email;
        $password = fake()->password;
        $response = $this->registerUser($email, $password);
    
        $this->assertEquals($response['success'], true);
    }

    public function test_login(): void
    {   
        $email = fake()->email;
        $password = fake()->password;
        
        $this->registerUser($email, $password);
        $response = $this->loginUser($email, $password);

        $this->assertEquals($response['success'], true);
    }

    public function test_auth(): void
    {
        $email = fake()->email;
        $password = fake()->password;
        $this->registerUser($email, $password);
        $login = $this->loginUser($email, $password);
        
        $this->assertEquals($login['success'], true);

    }
}
