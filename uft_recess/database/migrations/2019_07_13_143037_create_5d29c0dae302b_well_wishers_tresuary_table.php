<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5d29c0dae302bWellWishersTresuaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('well_wishers_tresuary')) {
            Schema::create('well_wishers_tresuary', function (Blueprint $table) {
                $table->integer('well_wishers_id')->unsigned()->nullable();
                $table->foreign('well_wishers_id', 'fk_p_320299_322893_tresua_5d29c0dae3141')->references('id')->on('well_wisherss')->onDelete('cascade');
                $table->integer('tresuary_id')->unsigned()->nullable();
                $table->foreign('tresuary_id', 'fk_p_322893_320299_crmcus_5d29c0dae31df')->references('id')->on('tresuaries')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('well_wishers_tresuary');
    }
}