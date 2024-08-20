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
        Schema::create('receipt_details', function (Blueprint $table) {
            $table->foreignId('receipt_id')
                  ->constrained('book_receipts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('book_id')
                  ->constrained('books')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('quantity');
            $table->string('status', 50)->default('Pending');
            $table->primary(['receipt_id', 'book_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_details');
    }
};
