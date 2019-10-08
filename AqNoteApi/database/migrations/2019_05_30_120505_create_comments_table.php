<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('idCO');
            $table->timestamps();
            $table->string('titleC');
            $table->string('text');
            $table->enum('like', [0,1,2,3,4,5]);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('note_id');
            $table->foreign('user_id')
                  ->references('idU')->on('users')
                  ->onDelete('cascade');
            $table->foreign('note_id')
              ->references('idN')->on('notes')
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
        Schema::dropIfExists('comments');
    }
}
