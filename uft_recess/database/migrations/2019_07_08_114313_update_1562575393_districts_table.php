<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562575393DistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
            
if (!Schema::hasColumn('districts', 'agent_head')) {
                $table->string('agent_head')->nullable();
                }
                if (!Schema::hasColumn('districts', 'agents')) {
                    $table->integer('agents')->nullable()->unsigned();
                    }
                    if (!Schema::hasColumn('districts', 'members')) {
                        $table->integer('members')->nullable()->unsigned();
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
        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('agent_head');
            $table->dropColumn('agents');
            $table->dropColumn('members');
            
        });

    }
}
