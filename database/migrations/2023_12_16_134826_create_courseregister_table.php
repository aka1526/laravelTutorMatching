<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_register', function (Blueprint $table) {
            $table->string('doc_no',50)->primary();
            $table->date('register_date')->nullable();
            $table->date('date_start')->nullable();
            $table->integer('register_max')->nullable()->default(0);
            $table->integer('register_month')->nullable()->default(0);
            $table->integer('register_year')->nullable()->default(0);
            $table->integer('user_id')->nullable()->default(0);
            $table->string('user_name',200)->nullable()->default('');
            $table->integer('course_id')->nullable()->default(0);
            $table->string('course_name',200)->nullable()->default('');
            $table->integer('tutor_id')->nullable()->default(0);
            $table->string('tutor_name',200)->nullable()->default('');
            $table->integer('course_price')->nullable()->default(0);
            $table->integer('course_hour')->nullable()->default(0);
            $table->string('payment_img',200)->nullable()->default('');
            $table->string('register_status')->nullable()->default('N');
            $table->dateTime('payment_datetime')->nullable();


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_register');
    }
}
