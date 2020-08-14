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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('domicile')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->string('moral_person_name')->nullable();
            $table->string('moral_person_description')->nullable();
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
