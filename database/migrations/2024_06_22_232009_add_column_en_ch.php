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
        Schema::table('menus', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ch')->nullable();
        });
        Schema::table('settings', function (Blueprint $table) {
            $table->text('value_en')->nullable();
            $table->text('value_ch')->nullable();
        });
        Schema::table('library_groups', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('libraries', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('post_groups', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('tour_groups', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ch')->nullable();
        });
        Schema::table('tours', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('destination_groups', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ch')->nullable();
        });
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('qa_groups', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
        });
        Schema::table('qas', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch', 'description_en', 'description_ch');
        });
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('value_en', 'value_ch');
        });
        Schema::table('library_groups', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('libraries', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('post_groups', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('tour_groups', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch', 'description_en', 'description_ch');
        });
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('destination_groups', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch', 'description_en', 'description_ch');
        });
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('qa_groups', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
        Schema::table('qas', function (Blueprint $table) {
            $table->dropColumn('name_en', 'name_ch');
        });
    }
};
