<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affaires', function (Blueprint $table) {
            $table->Increments('id');
            $table->biginteger('user_id')->unsigned();
            $table->string('presentation');
            $table->string('type');
            $table->integer('frais');
            $table->string('resultat');
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

            

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affaires');
    }
}
