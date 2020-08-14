<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('affaire_id')->unsigned();
            $table->tinyInteger('is_adversaire');
            $table->tinyInteger('is_moral');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->string('domicile');
            $table->string('father_name');
            $table->string('mother_first_name');
            $table->string('mother_last_name');
            $table->string('moral_person_name');
            $table->string('moral_person_description');
            $table->timestamps();
            $table->string('type');
            $table->foreign('affaire_id')->references('id')->on('affaires');
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
