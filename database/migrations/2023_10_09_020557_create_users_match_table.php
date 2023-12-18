<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users_match');
        Schema::create('users_match', function (Blueprint $table) {
            $table->id();
            $table->string('user_match_province');
            $table->string('user_match_Edlevel');
            $table->string('user_match_style');
            $table->string('user_match_gender');
            $table->unsignedBigInteger('user_id');
            $table->string('subject_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::dropIfExists('users_match');
    }
}