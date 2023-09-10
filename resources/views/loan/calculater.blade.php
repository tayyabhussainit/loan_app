@extends('layout')

@section('content')

<div class="calculator">
    <form id="calculator">
        <div class="row">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="loan_amount" id="loan_amount" placeholder="Loan Amount">
                        </td>
                        <td>
                            <input type="text" name="annual_interest_rate" id="annual_interest_rate" placeholder="Annual Interest Rate">
                        </td>
                        <td>
                            <input type="text" name="loan_term" id="loan_term" placeholder="Loan Term">
                        </td>
                        <td>
                            <input type="text" name="extra_payment" id="extra_payment" placeholder="Extra Payment">
                        </td>
                        <td>
                        <button type="button" id="logout" class="btn btn-dark">Logout</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" name="calculate" id="calculate" value="Calculate">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @include('partials._status')

    </form>
</div>
<div class="mt-5">
    <table id="header" class="display" style="width:100%"></table>\
</div> 

<div class="mt-5">
    <table id="plan" class="display" style="width:100%"></table>\
</div> 

@endsection