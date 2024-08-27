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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Foreign key to link with the users table i have to delete ->onDelete('cascade')

            $table->string('unic_id')->nullable();

            $table->string('fname');
            $table->string('lname');
            $table->string('email');

            $table->date('dob')->nullable();
            $table->string('gender')->nullable(); // Male , Female, Other
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('local_guardian_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            // $table->string('member_code')->nullable(); // generated automatically
            // $table->string('status')->nullable();

            // Members Information:
            $table->string('member_id')->nullable();
            $table->string('member_type')->nullable(); // Student,Faculty,Staff, Alumni, Guest, 'Student'   
            $table->string('membership_status')->nullable();    
            $table->date('joining_date')->nullable();
            $table->year('year_of_admission')->nullable();
            // ACADEMIC 
            $table->string('category')->nullable();
            $table->string('institute')->nullable();
            $table->string('faculty')->nullable();
            $table->string('department')->nullable();

            $table->string('course')->nullable();
            $table->string('designation')->nullable();

            $table->string('enrollment_number')->nullable();
            $table->string('employee_id')->nullable();
            // Personal
            $table->string('phone')->nullable();
            $table->string('alternate_email')->nullable();

            $table->text('present_address')->nullable();
            $table->text('present_city')->nullable();
            $table->text('present_pincode')->nullable();

            $table->text('permanent_address')->nullable();
            $table->text('permanent_city')->nullable();
            $table->text('permanent_pincode')->nullable();
            $table->string('permanent_phone')->nullable();

            $table->text('preferred_genres')->nullable();
            $table->string('preferred_language')->nullable();
            $table->string('favorite_resources')->nullable();

            $table->string('communication_preferences')->nullable();
            $table->text('research_interests')->nullable();
            $table->string('social_integration')->nullable();

            $table->string('image')->nullable();

            // $table->string('name');
            // $table->string('email');
            // $table->string('role_position')->nullable();
            // $table->string('faculty')->nullable();
            // $table->string('department')->nullable();
            // $table->string('unic_id')->nullable();
            // $table->string('phone_number')->nullable();
            // $table->string('alternate_email')->nullable();
            // $table->text('residential_address')->nullable();
            // $table->text('preferred_genres')->nullable();
            // $table->string('preferred_language')->nullable();
            // // $table->text('borrowed_books_history')->nullable();
            // $table->text('favorite_resources')->nullable();
            // $table->string('library_privileges')->nullable();
            // $table->text('access_levels')->nullable();
            // $table->string('communication_preferences')->nullable();
            // $table->boolean('two_factor_authentication')->default(false);
            // $table->dateTime('password_expiry')->nullable();
            // $table->text('research_interests')->nullable();
            // $table->string('social_integration')->nullable();
            // $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
