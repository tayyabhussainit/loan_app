<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * MortgageLoanCalculatorController
 * 
 * This controller will be used as the frontend part of mortgage loan calculater
 */
class MortgageLoanCalculatorController extends Controller
{
    /**
     * this action will load view of calculater
     */
    public function index()
    {
        return view('loan.calculater');
    }
}
