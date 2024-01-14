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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('cate_id')->index();
            $table->string('name');
            $table->string('background')->nullable();
            $table->string('images')->nullable();
            $table->text('description')->nullable();
            $table->datetime('day_created');
            $table->datetime('day_public')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->string('created_by');
            $table->string('tags')->nullable();
            $table->json('tour_link')->nullable();
            $table->foreign('cate_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};