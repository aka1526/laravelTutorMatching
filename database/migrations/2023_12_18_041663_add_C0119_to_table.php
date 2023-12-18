<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddC0119ToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('course_register', function (Blueprint $table) {

            $table->string('approve_status',50)->nullable()->default('W');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_register', function (Blueprint $table) {
            $table->dropColumn('approve_status');

        });
    }
}
