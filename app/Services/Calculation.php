<?php

namespace App\Services;

class Calculation
{
    public function calculateMonthlyPayment($loanAmount, $annualInterestRate, $loanTerm, $extraPayment): array
    {
        $loanAmount = $loanAmount;
        $monthlyInterestRate = $annualInterestRate / 12 / 100;
        $monthlyloanTerm = $loanTerm * 12;
        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$monthlyloanTerm));
        $response = [
            'monthly_payment' => $monthlyPayment,
            'loan_amount' => $loanAmount,
            'number_of_months' => $monthlyloanTerm,
            'loan_term' => $loanTerm,
            'extra_payment' => $extraPayment,
            'annual_interest_rate' => $annualInterestRate,
            'monthly_interest_rate' => $monthlyInterestRate,
        ];

        return $response;
    }
}
