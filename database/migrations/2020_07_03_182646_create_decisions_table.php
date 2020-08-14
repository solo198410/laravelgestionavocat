<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decisions', function (Blueprint $table) {
            $table->id();
            $table->integer('affaire_id')->unsigned();
            $table->date('date_decision');
            $table->string('type');
            $table->string('decision');
            $table->string('summary');
            $table->string('authority');
            $table->date('date_recours');
            //$table->string('location1');
            //$table->string('location2');
            $table->foreign('affaire_id')->references('id')->on('affaires');
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
        Schema::dropIfExists('decisions');
    }
}
