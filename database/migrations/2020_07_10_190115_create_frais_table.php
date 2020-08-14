<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frais', function (Blueprint $table) {
            $table->id();
            $table->integer('affaire_id')->unsigned();
            $table->date('date_versement');
            $table->Decimal('montant_total');
            $table->Decimal('versement');
            $table->Decimal('reste');
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
        Schema::dropIfExists('frais');
    }
}
