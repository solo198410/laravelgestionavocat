<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoritesjudiciairesIdToAffairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affaires', function (Blueprint $table) {
            $table->integer('autoritesjudiciaires_id')->unsigned()->nullable();
            $table->foreign('autoritesjudiciaires_id')->references('id')->on('autoritesjudiciaires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affaires', function (Blueprint $table) {
            $table->dropForeign(['autoritesjudiciaires_id']);
            $table->dropCulomn('autoritesjudiciaires_id');
        });
    }
}
