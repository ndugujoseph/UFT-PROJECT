<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5d2c4cea36aba5d2c4cea2ffbbWellWishersTresuaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('well_wishers_tresuary');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('well_wishers_tresuary')) {
            Schema::create('well_wishers_tresuary', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('well_wishers_id')->unsigned()->nullable();
            $table->foreign('well_wishers_id', 'fk_p_320299_322893_tresua_5d29c0dae0e1f')->references('id')->on('well_wisherss');
                $table->integer('tresuary_id')->unsigned()->nullable();
            $table->foreign('tresuary_id', 'fk_p_322893_320299_crmcus_5d29c0dae1c4b')->references('id')->on('tresuaries');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
