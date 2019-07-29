<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d2460d258ebfRelationshipsToWellWishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('well_wishers', function(Blueprint $table) {
            if (!Schema::hasColumn('well_wishers', 'district_id')) {
                $table->integer('district_id')->unsigned()->nullable();
                $table->foreign('district_id', '320299_5d2460ce68c28')->references('id')->on('register_agents')->onDelete('cascade');
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
