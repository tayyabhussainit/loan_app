<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_amortization_schedule', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('month_number');
            $table->double('starting_balance');
            $table->float('monthly_payment');
            $table->float('principal_component');
            $table->float('interest_component');
            $table->double('ending_balance');
            $table->unsignedBigInteger('mortgage_loan_id');
            $table->foreign('mortgage_loan_id')->references('id')->on('mortgage_loans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_amortization_schedule');
    }
};
