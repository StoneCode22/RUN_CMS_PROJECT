<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This migration file is responsible for creating (and deleting) the main tables needed for user authentication and session management.

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is called when you run "php artisan migrate".
     * It creates the tables in your database.
     */
    public function up(): void
    {
        // Create the "users" table to store user information
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (id)
            $table->string('name'); // User's name
            $table->string('matric_no')->unique(); // User's matric number (must be unique)
            $table->string('phone'); // User's phone number
            $table->string('department'); // User's department
            $table->string('email')->unique(); // User's email (optional, must be unique if provided)
            $table->timestamp('email_verified_at')->nullable(); // When the email was verified (optional)
            $table->string('password'); // User's password (hashed)
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created at and updated at timestamps
        });


        // Create the "password_reset_tokens" table for password reset functionality
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // The user's email (primary key)
            $table->string('token'); // The reset token
            $table->timestamp('created_at')->nullable(); // When the token was created
        });


        // Create the "sessions" table to store session data (used if SESSION_DRIVER=database)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID (primary key)
            $table->foreignId('user_id')->nullable()->index(); // The user's ID (if logged in)
            $table->string('ip_address', 45)->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // Browser or device info
            $table->longText('payload'); // The session data
            $table->integer('last_activity')->index(); // Last activity timestamp
        });
    }


    /**
     * Reverse the migrations.
     * This method is called when you run "php artisan migrate:rollback".
     * It deletes the tables created above.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Delete the "users" table
        Schema::dropIfExists('password_reset_tokens'); // Delete the "password_reset_tokens" table
        Schema::dropIfExists('sessions'); // Delete the "sessions" table
    }
};
