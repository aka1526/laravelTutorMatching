<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('info_tutors');
        Schema::create('info_tutors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id')->unique();
            $table->string('info_tutor_education')->nullable();
            $table->string('info_tutor_faculty')->nullable();
            $table->string('info_tutor_major')->nullable();
            $table->string('info_tutor_grade')->nullable();
            $table->string('info_tutor_univercity')->nullable();
            $table->string('info_tutor_location')->nullable();
            $table->string('info_tutor_exp')->nullable();
            $table->timestamps();
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_tutors');
    }
}
