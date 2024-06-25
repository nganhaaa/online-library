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
        Schema::create('borrowing_receipts', function (Blueprint $table) {
            $table->string('receipt_id', 50)->primary();
            $table->string('employee_account_id', 50);
            $table->string('member_account_id', 50);
            $table->string('fee_id', 50);
            $table->date('borrow_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->string('status', 50);

            $table->foreign('employee_account_id')->references('account_id')->on('accounts');
            $table->foreign('member_account_id')->references('account_id')->on('accounts');
            $table->foreign('fee_id')->references('fee_id')->on('fees');

            $table->index('employee_account_id');
            $table->index('member_account_id');
            $table->index('fee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_receipts');
    }
};
