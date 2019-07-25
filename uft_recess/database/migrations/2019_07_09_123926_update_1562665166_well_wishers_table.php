<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562665166CrmCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            
if (!Schema::hasColumn('crm_customers', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('crm_customers', 'amount')) {
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
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('amount');
            
        });

    }
}
