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
            $table->unsignedBigInteger('group_id')->index()->nullable();
            $table->unsignedBigInteger('province_id')->index()->nullable();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency', 10)->nullable()->default('vnd');
            $table->datetime('day_start')->nullable();
            $table->string('image')->nullable();
            $table->string('background')->nullable();
            $table->string('duration')->nullable();
            $table->string('country')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->text('content')->nullable();
            $table->string('schedule_file')->nullable();
            $table->text('include')->nullable();
            $table->text('exclude')->nullable();
            $table->text('term')->nullable();
            $table->text('notice')->nullable();
            $table->integer('important')->nullable()->default(0);
            $table->json('tags')->nullable();
            $table->json('images')->nullable();
            $table->integer('view_total')->nullable()->default(0);
            $table->integer('like_total')->nullable()->default(0);
            $table->integer('type')->nullable()->default(0);
            $table->boolean('design')->nullable()->default(0);
            $table->integer('bundle')->nullable()->default(0);
            $table->string('season', 30)->nullable();
            $table->enum('status', ['draft', 'active', 'blocked'])->index()->nullable()->default('draft');
            $table->foreign('group_id')->references('id')->on('tour_groups');
            $table->foreign('country_id')->references('id')->on('countries');
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
};
