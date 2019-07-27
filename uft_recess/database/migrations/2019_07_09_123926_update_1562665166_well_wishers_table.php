<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562665166WellWishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('well_wishers', function (Blueprint $table) {
            
if (!Schema::hasColumn('well_wishers', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('well_wishers', 'amount')) {
                $table->double('amount', 4, 2)->nullable();
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
        Schema::table('well_wishers', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('amount');
            
        });

    }
}
