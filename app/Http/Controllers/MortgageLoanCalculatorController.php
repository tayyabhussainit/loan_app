<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MortgageLoanCalculatorController extends Controller
{
    public function index()
    {
        return view('loan.calculater');
    }
}
