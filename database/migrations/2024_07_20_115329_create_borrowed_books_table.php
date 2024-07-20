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
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->string('receipt_id', 50);
            $table->string('book_id', 50);
            $table->integer('quantity');
            $table->string('status')->default('reserved');
            $table->timestamps();

            $table->primary(['receipt_id', 'book_id']);

            $table->foreign('receipt_id')->references('receipt_id')->on('borrowing_receipts')->onDelete('cascade');
            $table->foreign('book_id')->references('book_id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowed_books');
    }
};
