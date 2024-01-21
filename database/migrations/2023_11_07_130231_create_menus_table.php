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
        Schema::create('menus', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('link')->nullable()->default('');
            $table->string('active')->nullable()->default('');
            $table->string('description')->nullable()->default('');
            $table->integer('numering')->nullable()->default(0);
            $table->string('icon')->nullable();
            $table->string('background')->nullable();
            $table->json('images')->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
