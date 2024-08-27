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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_user_id')->constrained()->onDelete('cascade'); // Foreign key linking to users table
            $table->string('unic_id')->nullable(); // Store the external user ID received from the remote server, nullable if not found
            $table->string('page_name')->nullable(false);
            $table->string('url')->nullable(false);
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('time_spent')->default(0);
            $table->timestamps();
            $table->string('session_id')->nullable();

            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
