<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562574337MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            
if (!Schema::hasColumn('members', 'gender')) {
                $table->string('gender')->nullable();
                }
if (!Schema::hasColumn('members', 'recommendees')) {
                $table->integer('recommendees')->nullable()->unsigned();
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
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('recommendees');
            
        });

    }
}
