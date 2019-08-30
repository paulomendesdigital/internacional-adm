<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElegibilidadeProfissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elegibilidade_profission', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('elegibilidade_id');
            $table->foreign('elegibilidade_id')->references('id')->on('elegibilidades')->onDelete('cascade');

            $table->unsignedBigInteger('profission_id');
            $table->foreign('profission_id')->references('id')->on('profissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elegibilidade_profission');
    }
}
