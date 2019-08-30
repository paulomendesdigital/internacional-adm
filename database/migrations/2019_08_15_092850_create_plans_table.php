<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modality_id');
            $table->foreign('modality_id')->references('id')->on('modalities')->onDelete('cascade');

            $table->unsignedBigInteger('operadora_id');
            $table->foreign('operadora_id')->references('id')->on('operadoras')->onDelete('cascade');

            $table->unsignedBigInteger('elegibilidade_id')->nullable();
            $table->foreign('elegibilidade_id')->references('id')->on('elegibilidades')->onDelete('cascade');

            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->string('name', 100);
            $table->integer('abrangencia');

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
        Schema::dropIfExists('plans');
    }
}
