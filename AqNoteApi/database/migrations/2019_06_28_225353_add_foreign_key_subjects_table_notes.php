<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeySubjectsTableNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                ->references('id')->on('subjects')
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
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                ->references('id')->on('subjects')
                ->onDelete('cascade');
        });
    }
}
