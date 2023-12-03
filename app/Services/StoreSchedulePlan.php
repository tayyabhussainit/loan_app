<?php

namespace App\Services;

use App\Models\ExtraRepaymentSchedule;
use App\Models\LoanAmortizationSchedule;
use App\Models\MortgageLoan;

class StoreSchedulePlan
{
    private $loanDetails;
    private $mortgageLoan;
    public function storeSchedule($loanDetails)
    {
        $this->loanDetails = $loanDetails;
        $this->storeMortgageLoan();
        return $this->storeAmortizationSchedule();
    }

    private function storeMortgageLoan()
    {
        $this->mortgageLoan = MortgageLoan::create([
            'loan_amount' => $this->loanDetails['loan_amount'],
            'loan_term' => $this->loanDetails['loan_term'],
            'annual_interest_rate' => $this->loanDetails['annual_interest_rate'],
            'extra_payment' => $this->loanDetails['extra_payment']
        ]);
    }

    private function storeAmortizationSchedule()
    {
        $lastEndingBalance = null;

        $numberOfMonth = $this->loanDetails['number_of_months'];

        $amortizationSchedule = [];

        $flagExtraPayment = false;

        for ($i = 1; $i <= $numberOfMonth; $i++) {

            $scheduleDetail['mortgage_loan_id'] = $this->mortgageLoan->id;
            $scheduleDetail['month_number'] = $i;
            $scheduleDetail['starting_balance'] = $lastEndingBalance ?? $this->loanDetails['loan_amount'];
            $scheduleDetail['monthly_payment'] = $this->loanDetails['monthly_payment'];
            $scheduleDetail['interest_component'] = $scheduleDetail['starting_balance'] * $this->loanDetails['monthly_interest_rate'];
            $scheduleDetail['principal_component'] = $this->loanDetails['monthly_payment'] - $scheduleDetail['interest_component'];
            $scheduleDetail['ending_balance'] = $scheduleDetail['starting_balance'] - $scheduleDetail['principal_component'];

            if (isset($scheduleDetail['extra_payment'])) {
                $scheduleDetail['extra_payment'] = null;
            }
            if ($this->loanDetails['extra_payment']) {
                $flagExtraPayment = true;
                $scheduleDetail['extra_payment'] = $this->loanDetails['extra_payment'];
                $scheduleDetail['ending_balance'] = $scheduleDetail['ending_balance'] - $this->loanDetails['extra_payment'];
                $this->loanDetails['extra_payment'] = null;
            }

            if ($flagExtraPayment && $scheduleDetail['ending_balance'] < 0) {
                $scheduleDetail['monthly_payment'] = $scheduleDetail['starting_balance'] + $scheduleDetail['interest_component'];
                $scheduleDetail['principal_component'] = $scheduleDetail['monthly_payment'] - $scheduleDetail['interest_component'];
                $scheduleDetail['ending_balance'] = $scheduleDetail['starting_balance'] - $scheduleDetail['principal_component'];
                $amortizationSchedule[] = $scheduleDetail;
                break;
            }

            $lastEndingBalance = $scheduleDetail['ending_balance'];
            $scheduleDetail['ending_balance'] = round($scheduleDetail['ending_balance'], 2);
            $amortizationSchedule[] = $scheduleDetail;
        }
        if (!$flagExtraPayment) {
            LoanAmortizationSchedule::insert($amortizationSchedule);
        } else {
            ExtraRepaymentSchedule::insert($amortizationSchedule);
        }

        return ['plan' => $amortizationSchedule, 'header' => $this->loanDetails, 'flag_extra_payment' => $flagExtraPayment];
    }
}
