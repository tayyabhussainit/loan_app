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
        Schema::create('extra_repayment_schedule', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('month_number');
            $table->double('starting_balance', 12, 2);
            $table->float('monthly_payment', 8, 2);
            $table->float('principal_component', 8, 2);
            $table->float('interest_component', 8, 2);
            $table->double('ending_balance', 12, 2);
            $table->double('extra_payment', 12, 2)->nullable();
            $table->unsignedBigInteger('mortgage_loan_id');
            $table->foreign('mortgage_loan_id')->references('id')->on('mortgage_loans');
            $table->timestamps();
            // (`ending_balance`, `extra_payment`, `interest_component`, `month_number`, `monthly_payment`,
            // `mortgage_loan_id`, `principal_component`, `starting_balance`) 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_repayment_schedule');
    }
};
