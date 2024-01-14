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
            $table->string('value')->nullable();
            $table->text('description')->nullable();
            $table->string('type', 10)->index()->nullable()->default('text');
            $table->json('data_json')->nullable();
            $table->integer('numering');
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->foreign('group_id')->references('id')->on('setting_groups')->onDelete('cascade');
            $table->timestamps();
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