<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNatureaffairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('natureaffaires', function (Blueprint $table) {
            $table->id();
            $table->integer('autoritesjudiciaire_id')->unsigned();
            $table->string('nature');
            $table->foreign('autoritesjudiciaire_id')->references('id')->on('autoritesjudiciaires');
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
        Schema::dropIfExists('natureaffaires');
    }
}
