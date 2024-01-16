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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->string('name');
            $table->string('link');
            $table->string('created_by');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('important')->nullable()->default(0);
            $table->integer('numering')->nullable()->default(0);
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->foreign('group_id')->references('id')->on('library_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
