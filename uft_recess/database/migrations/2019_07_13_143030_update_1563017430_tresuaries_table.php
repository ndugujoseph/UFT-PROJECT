<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1563017430TresuariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tresuaries', function (Blueprint $table) {
            if(Schema::hasColumn('tresuaries', 'da')) {
                $table->dropColumn('da');
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
        Schema::table('tresuaries', function (Blueprint $table) {
                        $table->string('da')->nullable();
                
        });

    }
}
