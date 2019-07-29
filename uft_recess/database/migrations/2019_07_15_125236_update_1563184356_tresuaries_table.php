<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1563184356TresuariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tresuaries', function (Blueprint $table) {
            
if (!Schema::hasColumn('tresuaries', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('tresuaries', 'total')) {
                $table->decimal('total', 15, 2)->nullable();
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
            $table->dropColumn('date');
            $table->dropColumn('total');
            
        });

    }
}
