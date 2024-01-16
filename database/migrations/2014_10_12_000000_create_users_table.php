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
            $table->id()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('active_code')->nullable()->unique();
            $table->timestamp('active_expire')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('description')->nullable();
            $table->rememberToken();
            $table->dateTime('last_login')->nullable();
            $table->enum('status', ['un_active', 'active', 'blocked'])->index()->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
