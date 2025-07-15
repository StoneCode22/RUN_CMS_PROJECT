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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('admin_id')->unique();
            $table->string('email')->unique()->nullable(); // Admin's email (optional, must be unique if provided)
            $table->timestamp('email_verified_at')->nullable(); // When the email was verified (optional)
            $table->string('phone')->nullable(); // Admin's phone number (optional)
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
