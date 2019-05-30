<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreeCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degree_courses', function (Blueprint $table) {
            $table->bigIncrements('idDC');
            $table->timestamps();
            $table->string('nameDC', 30);
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                  ->references('idD')->on('departments')
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
        Schema::dropIfExists('degree_courses');
    }
}
