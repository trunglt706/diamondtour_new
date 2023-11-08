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
            $table->unsignedBigInteger('group_id')->index();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('album')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->json('tag')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
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
