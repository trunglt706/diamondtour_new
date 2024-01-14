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
            $table->string('phone');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('total_adult')->nullable()->default(1);
            $table->integer('total_children')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->string('content')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
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
