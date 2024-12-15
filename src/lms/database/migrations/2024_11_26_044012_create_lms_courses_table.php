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
        Schema::create('lms_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('img_course')->default('');
            $table->string('img_thumbnail')->default('');
            $table->string('img_background')->default('');
            $table->string('title')->default('');
            $table->string('permalink')->default('');
            $table->string('overview')->default('');
            $table->string('target')->default('');
            $table->string('metadata')->default('');
            $table->integer('hours')->default(0);
            $table->integer('level')->default(0);
            $table->integer('price')->default(0);
            $table->integer('type_display')->length(1)->default(1);
            $table->integer('type_progress')->length(1)->default(1);
            $table->integer('type_comment')->length(1)->default(1);
            $table->integer('type_requirement')->length(1)->default(1);
            $table->integer('total_students')->default(0);
            $table->integer('total_completers')->default(0);
            $table->boolean('is_review')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lms_courses');
    }
};
