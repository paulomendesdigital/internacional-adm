<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->unsignedBigInteger('modality_id');
            $table->foreign('modality_id')->references('id')->on('modalities')->onDelete('cascade');

            $table->unsignedBigInteger('profission_id')->nullable();
            $table->foreign('profission_id')->references('id')->on('profissions')->onDelete('cascade');

            $table->string('name', 100);
            $table->string('phone', 17)->nullable();

            $table->string('email')->nullable();
            $table->date('birth')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
