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
        Schema::create('settings', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('value')->nullable();
            $table->enum('type', ['text', 'textarea', 'radio', 'checkbox', 'color', 'editor', 'file', 'images'])->nullable()->default('text');
            $table->json('data')->nullable();
            $table->string('description')->nullable();
            $table->integer('numering')->nullable()->default(0);
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('setting_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
