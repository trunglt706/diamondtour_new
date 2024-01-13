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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('tour_id')->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('numering')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};