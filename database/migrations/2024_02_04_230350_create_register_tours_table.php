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
        Schema::create('register_tours', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone');
            $table->integer('adults')->nullable();
            $table->integer('children')->nullable();
            $table->string('other')->nullable();
            $table->text('content');
            $table->enum('status', ['un_active', 'active', 'blocked'])->index()->nullable()->default('un_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_tours');
    }
};
