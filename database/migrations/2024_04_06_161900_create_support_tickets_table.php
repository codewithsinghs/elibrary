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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('ticket_id')->unique();
            $table->string('category');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('open');
            $table->text('reply')->nullable();
            
           // $table->unsignedBigInteger('ticket_id')->unique(); // Change to unsignedBigInteger for numeric ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
