<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Withfake;
use Tests\TestCase;
use App\Models\User;

class MonthlyPlanTest extends TestCase
{
   // use DatabaseMigrations, RefreshDatabase;

   public function test_monthlyPlan(): void
   {
      $loanAmount = 300000;
      $annualInterestRate = 5;
      $laonTerm = 30;

      $name = fake()->name;
      $email = fake()->email;
      $password = fake()->password;
      $this->registerUser($name, $email, $password, $password);
      $login = $this->loginUser($email, $password);
      $response = $this->withHeaders([
         'Accept' => 'application/json',
         'Authorization' => 'Bearer ' . $login['data']['token']
      ])->post('/api/calculate_monthly_plan', [
         'loan_amount' => $loanAmount,
         'annual_interest_rate' => $annualInterestRate,
         'loan_term' => $laonTerm
      ])->json();

      $this->assertEquals(round($response['data']['header']['monthly_payment'], 2), round(1610.4648690364, 2));
   }
}
