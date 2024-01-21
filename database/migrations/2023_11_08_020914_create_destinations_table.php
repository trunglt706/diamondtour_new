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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('province_id')->index()->nullable();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('address')->nullable();
            $table->string('price')->nullable();
            $table->integer('important')->nullable()->default(0);
            $table->json('tags')->nullable();
            $table->integer('view_total')->nullable()->default(0);
            $table->integer('like_total')->nullable()->default(0);
            $table->enum('status', ['un_active', 'active', 'blocked'])->index()->nullable()->default('un_active');
            $table->foreign('group_id')->references('id')->on('destination_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
