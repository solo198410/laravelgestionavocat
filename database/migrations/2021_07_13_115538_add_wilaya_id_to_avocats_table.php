<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWilayaIdToAvocatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avocats', function (Blueprint $table) {
            $table->biginteger('wilaya_id')->unsigned()->nullable();
            $table->foreign('wilaya_id')->references('id')->on('wilayas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avocats', function (Blueprint $table) {
            $table->dropForeign(['wilaya_id']);
            $table->dropCulomn('wilaya_id');
        });
    }
}
