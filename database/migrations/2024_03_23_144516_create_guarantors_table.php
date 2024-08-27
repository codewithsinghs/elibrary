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
        Schema::create('guarantors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('gr_fname')->nullable();
            $table->string('gr_lname')->nullable();
            $table->string('form_number')->nullable();
            $table->string('library_member')->nullable();
            $table->string('gr_phone')->nullable();
            $table->string('gr_email')->nullable();
            $table->string('gr_address')->nullable();
            $table->string('gr_city')->nullable();
            $table->string('gr_pincode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guarantors');
    }
};
