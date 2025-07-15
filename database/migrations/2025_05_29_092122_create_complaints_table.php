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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('category');
            $table->string('location');
            $table->date('date')->nullable();
            $table->text('description');
            $table->text('suggested_solution')->nullable();
            $table->string('urgency');
            $table->string('attachment')->nullable();
            $table->boolean('terms')->default(false);
            $table->string('user_id');
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
