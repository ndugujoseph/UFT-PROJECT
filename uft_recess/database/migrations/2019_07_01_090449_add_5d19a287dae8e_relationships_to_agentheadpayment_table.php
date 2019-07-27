<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d19a287dae8eRelationshipsToAgentHeadPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_head_payment', function(Blueprint $table) {
            if (!Schema::hasColumn('agent_head_payment', 'well_wishers_id')) {
                $table->integer('well_wishers_id')->unsigned()->nullable();
                $table->foreign('well_wishers_id', '320300_5d19a2837cdc2')->references('id')->on('well_wishers')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_head_payment', function(Blueprint $table) {
            
        });
    }
}
