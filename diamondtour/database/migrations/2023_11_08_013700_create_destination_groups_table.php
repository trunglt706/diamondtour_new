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
        Schema::create('destination_groups', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique()->index();
            $table->string('name');
            $table->string('image');
            $table->string('description')->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_groups');
    }
};