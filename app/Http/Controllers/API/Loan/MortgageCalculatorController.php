<?php

namespace App\Http\Controllers\API\Loan;

use App\Http\Requests\CalculateMonthlyPlanRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\Calculation;
use App\Services\StoreSchedulePlan;

class MortgageCalculatorController extends BaseController
{
    public function __construct(
        private Calculation $calculationService,
        private StoreSchedulePlan $storeSchedulePlanService
    ) {
    }
    public function calculateMonthlyPlan(CalculateMonthlyPlanRequest $request)
    {
        $response = $this->calculationService->calculateMonthlyPayment(
            $request->input('loan_amount'),
            $request->input('annual_interest_rate'),
            $request->input('loan_term'),
            $request->input('extra_payment', null)
        );
        $response = $this->storeSchedulePlanService->storeSchedule($response);

        return $this->sendResponse($response, '');
    }
}
