<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('news');
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('news_id');
            $table->string('news_title');
            $table->string('news_detail');
            $table->string('news_tel');
            $table->string('news_img');
            $table->string('news_status');
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
        Schema::dropIfExists('news');
    }
}
