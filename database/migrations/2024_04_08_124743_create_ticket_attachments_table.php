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
        // Schema::create('ticket_attachments', function (Blueprint $table) {
        //     $table->id();
        //     // $table->foreignId('support_ticket_id')->constrained()->onDelete('cascade');
        //     $table->unsignedBigInteger('support_ticket_id');
        //     $table->unsignedBigInteger('ticket_reply_id')->nullable(); // New column
        //     $table->string('file_name');
        //     $table->string('file_path');
        //     $table->timestamps();

        //     $table->foreign('support_ticket_id')->references('id')->on('support_tickets')->onDelete('cascade');
        //     $table->foreign('ticket_reply_id')->references('id')->on('ticket_replies')->onDelete('cascade'); // Foreign key constraint for ticket replies

        // });

        Schema::create('ticket_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('attachable_id');
            $table->string('attachable_type');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();

    
            $table->foreign('ticket_id')->references('ticket_id')->on('support_tickets')->onDelete('cascade');

    //          // Define polymorphic relationship
    // $table->morphs('attachable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_attachments');
    }
};
