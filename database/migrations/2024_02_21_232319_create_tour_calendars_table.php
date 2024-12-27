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
        Schema::create('tour_calendars', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('tour_id')->index();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->integer('empty')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->boolean('display')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_calendars');
    }
};
