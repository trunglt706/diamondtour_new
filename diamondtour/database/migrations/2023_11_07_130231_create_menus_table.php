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
        Schema::create('menus', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('link')->nullable()->default('');
            $table->integer('numering')->nullable()->default(0);
            $table->string('icon')->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
