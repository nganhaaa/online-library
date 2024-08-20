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
            $table->id();  
            $table->string('name', 200);  
            $table->longText('description'); 
            $table->foreignId('age_group_id')
                  ->constrained('age_groups')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('publisher_id')
                  ->constrained('publishers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->unsignedInteger('publication_year');  
            $table->unsignedInteger('available');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('price');
            $table->string('image')->nullable();
            $table->timestamps();
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
