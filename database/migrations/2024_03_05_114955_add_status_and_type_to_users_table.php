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
        Schema::table('users', function (Blueprint $table) {
            // Add 'status' column to track user account status
            $table->enum('status', ['active', 'suspended', 'pending', 'inactive', 'blocked', 'pending_payment', 'needs_verification', 'on_hold'])
                //   ->default('pending_approval')
                ->nullable() // Make the column nullable
                  ->comment('The status of the user account');

            // Add 'type' column to differentiate between user types
            $table->enum('type', ['local', 'remote', 'admin', 'librarian', 'premium', 'guest', 'trial', 'partner', 'demo'])
                //   ->default('local')
                ->nullable() // Make the column nullable
                  ->comment('The type of user: local, remote, admin, librarian, premium, guest, trial, partner, demo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop 'status' and 'type' columns when rolling back migration
            $table->dropColumn(['status', 'type']);
        });
    }
};
