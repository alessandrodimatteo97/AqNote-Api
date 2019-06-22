<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyDegreeCoursesTableNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
          $table->unsignedBigInteger('degreeCourse_id');
          $table->foreign('degreeCourse_id')
                ->references('idDC')->on('degree_courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
          $table->unsignedBigInteger('degreeCourse_id');
          $table->foreign('degreeCourse_id')
                ->references('idDC')->on('degree_courses')
                ->onDelete('cascade');
        });
    }
}
