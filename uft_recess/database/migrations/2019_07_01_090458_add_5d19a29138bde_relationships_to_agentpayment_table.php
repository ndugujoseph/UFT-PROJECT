<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d19a29138bdeRelationshipsToAgentHeadPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_head_payments', function(Blueprint $table) {
            if (!Schema::hasColumn('agent_head_payments', 'well_wishers_id')) {
                $table->integer('well_wishers_id')->unsigned()->nullable();
                $table->foreign('well_wishers_id', '320301_5d19a28ca94c4')->references('id')->on('well_wishers')->onDelete('cascade');
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
        Schema::table('agent_head_payments', function(Blueprint $table) {
            
        });
    }
}
