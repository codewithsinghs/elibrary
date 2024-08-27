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
        Schema::create('academic_entities', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('institute')->nullable();
            $table->string('faculty')->nullable();  
            $table->string('department')->nullable();
            $table->string('course')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_entities');
    }
};
