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
        Schema::create('tour_groups', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('country_id')->index()->nullable();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('numering')->nullable()->default(0);
            $table->integer('starts')->nullable();
            $table->string('days')->nullable();
            $table->string('personals')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_groups');
    }
};
