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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('group_id')->index()->nullable();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('background')->nullable();
            $table->json('album')->nullable()->default(json_encode([]));
            $table->json('tours')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->integer('important')->nullable()->default(0);
            $table->json('tags')->nullable();
            $table->integer('view_total')->nullable()->default(0);
            $table->integer('like_total')->nullable()->default(0);
            $table->boolean('tieu_diem')->nullable()->default(false);
            $table->boolean('hot')->nullable()->default(false);
            $table->enum('status', ['draft', 'active', 'blocked'])->index()->nullable()->default('draft');
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('post_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
