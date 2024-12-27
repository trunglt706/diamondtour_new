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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable()->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('content');
            $table->text('script')->nullable();
            $table->string('image')->nullable();
            $table->string('background')->nullable();
            $table->enum('status', ['active', 'blocked'])->nullable()->default('active');
            $table->boolean('important')->nullable()->default(0);
            $table->boolean('home')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
