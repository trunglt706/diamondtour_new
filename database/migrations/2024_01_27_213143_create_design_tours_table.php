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
        Schema::create('design_tours', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('tour_group_id')->index()->nullable();
            $table->unsignedBigInteger('someone_id')->index()->nullable();
            $table->unsignedBigInteger('type_id')->index()->nullable();
            $table->unsignedBigInteger('service_id')->index()->nullable();
            $table->unsignedBigInteger('age_id')->index()->nullable();
            $table->unsignedBigInteger('place_id')->index()->nullable();
            $table->unsignedBigInteger('balance_id')->index()->nullable();
            $table->unsignedBigInteger('style_id')->index()->nullable();
            $table->string('someone_other')->nullable();
            $table->integer('adults')->nullable()->default(1);
            $table->integer('children')->nullable()->default(0);
            $table->string('place_start_other')->nullable();
            $table->enum('time_tour', ['none', 'calendar'])->nullable()->default('none');
            $table->date('expected_date')->nullable();
            $table->integer('choose_date_number')->nullable()->default(0);
            $table->integer('expected_date_number')->nullable();
            $table->integer('tour_guide')->nullable()->default(0);
            $table->text('message')->nullable();
            $table->text('special')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('agree_terms')->nullable()->default(0);
            $table->enum('status', ['un_active', 'active', 'blocked'])->index()->nullable()->default('un_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_tours');
    }
};
