<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d245f0bc4713RelationshipsToAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function(Blueprint $table) {
            if (!Schema::hasColumn('agents', 'role_id')) {
                $table->integer('role_id')->unsigned()->nullable();
                $table->foreign('role_id', '320298_5d245f074be2b')->references('id')->on('roles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('agents', 'district_id')) {
                $table->integer('district_id')->unsigned()->nullable();
                $table->foreign('district_id', '320298_5d245f076a446')->references('id')->on('register_agents')->onDelete('cascade');
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
        Schema::table('agents', function(Blueprint $table) {
            
        });
    }
}
