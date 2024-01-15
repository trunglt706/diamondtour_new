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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->integer('total_adult')->nullable()->default(1);
            $table->integer('total_children')->nullable()->default(0);
            $table->string('description')->nullable();
            $table->string('content')->nullable();
            $table->enum('status', ['un_active', 'active', 'blocked'])->index()->nullable()->default('un_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
