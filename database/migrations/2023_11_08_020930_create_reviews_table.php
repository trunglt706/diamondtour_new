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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('destination_id')->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('vendor')->nullable();
            $table->integer('important')->nullable()->default(0);
            $table->enum('type', ['auto', 'manual'])->nullable()->default('manual');
            $table->text('content')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->timestamps();
            $table->foreign('destination_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
