<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tutors');
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->string('tutor_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_tutor')->nullable();
            $table->string('tutor_firstname')->nullable();
            $table->string('tutor_lastname')->nullable();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('file')->nullable();
            $table->string('tutor_img')->nullable();
            $table->string('tutor_tel')->nullable();
            $table->string('tutor_address')->nullable();
            $table->date('tutor_birthdate')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('tutors');
    }
}



