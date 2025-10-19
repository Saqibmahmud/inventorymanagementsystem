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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Required for Breeze registration form
            $table->string('email')->unique(); // Required for login and uniqueness
            $table->timestamp('email_verified_at')->nullable(); // For email verification feature
            $table->string('password') ;// Required for login
            $table->rememberToken(); // For "Remember Me" functionality
            $table->timestamps();
        });

        // The default Laravel install often includes these extra tables in separate migrations.
        // If your project uses Laravel's default migration set, ensure you also have:
        // * password_resets_table
        // * personal_access_tokens_table
        // * failed_jobs_table
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};