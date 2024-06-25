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
        Schema::create('books', function (Blueprint $table) {
            $table->string('book_id', 50)->primary();
            $table->string('book_name', 50);
            $table->string('age_group_id', 50);
            $table->string('publisher_id', 50);
            $table->integer('publication_year');
            $table->integer('available');
            $table->integer('quantity');
            $table->integer('price');

            // Add foreign key constraints
            $table->foreign('age_group_id')->references('age_group_id')->on('age_groups');
            $table->foreign('publisher_id')->references('publisher_id')->on('publishers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
