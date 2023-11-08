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
        Schema::create('tours', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->nullable()->default('VND');
            $table->date('date_start')->nullable();
            $table->string('background')->nullable();
            $table->integer('duration')->nullable();
            $table->text('destination_content')->nullable();
            $table->string('schedule_file')->nullable();
            $table->text('include')->nullable();
            $table->text('exclude')->nullable();
            $table->text('term')->nullable();
            $table->text('notice')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
