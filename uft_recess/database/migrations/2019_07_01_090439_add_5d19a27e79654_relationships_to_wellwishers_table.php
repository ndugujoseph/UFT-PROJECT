<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d19a27e79654RelationshipsToWellWishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('well_wishers', function(Blueprint $table) {
            if (!Schema::hasColumn('well_wishers', 'agents_id')) {
                $table->integer('agents_id')->unsigned()->nullable();
                $table->foreign('agents_id', '320299_5d19a279a9806')->references('id')->on('agentses')->onDelete('cascade');
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
        Schema::table('well_wishers', function(Blueprint $table) {
            
        });
    }
}
