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
        Schema::create('log_actions', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->json('data_json')->nullable();
            $table->string('description');
            $table->ipAddress('ip')->nullable()->index();
            $table->string('device')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_actions');
    }
};
