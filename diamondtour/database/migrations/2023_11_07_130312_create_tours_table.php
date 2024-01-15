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
        Schema::create('tours', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('province_id')->index()->nullable();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency',10)->nullable()->default('vnd');
            $table->datetime('day_start')->nullable();
            $table->string('background')->nullable();
            $table->string('duration')->nullable();
            $table->text('content')->nullable();
            $table->string('schedule_file')->nullable();
            $table->text('include')->nullable();
            $table->text('exclude')->nullable();
            $table->text('term')->nullable();
            $table->text('notice')->nullable();
            $table->integer('important')->nullable()->default(0);
            $table->json('tags')->nullable();
            $table->integer('view_total')->nullable()->default(0);
            $table->integer('like_total')->nullable()->default(0);
            $table->enum('status', ['draft', 'active', 'blocked'])->index()->nullable()->default('draft');
            $table->foreign('group_id')->references('id')->on('tour_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
<<<<<<< HEAD
};
=======
};
>>>>>>> d2b2c3a4d0a14c1ce32ef300b7da2716de2e9c51
