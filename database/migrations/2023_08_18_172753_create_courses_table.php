<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::dropIfExists('courses');
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_img');
            $table->string('course_name');
            $table->string('course_information');
            $table->string('course_time');
            $table->string('course_level');
            $table->string('course_type');
            $table->string('course_target');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}