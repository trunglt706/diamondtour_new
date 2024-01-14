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
        Schema::create('destination_details', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('destination_id')->index();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('content');
            $table->string('images')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('time_public')->nullable();
            $table->timestamp('time_created');
            $table->integer('admin_id');
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->integer('numering');
            $table->string('tags')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_details');
    }
};