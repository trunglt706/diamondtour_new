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
            $table->integer('parent_id')->nullable()->index();
            $table->string('code')->index();
            $table->string('name',100);
            $table->string('url',256)->nullable();
            $table->integer('numering')->nullable()->default(0);
            $table->string('icon',100)->nullable();
            $table->enum('status', ['active', 'blocked'])->index()->nullable()->default('active');
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