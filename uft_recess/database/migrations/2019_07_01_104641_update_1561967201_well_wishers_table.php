<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1561967201CrmCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_customers', function (Blueprint $table) {
            if(Schema::hasColumn('crm_customers', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if(Schema::hasColumn('crm_customers', 'crm_status_id')) {
                $table->dropForeign('320299_5d19a279a9806');
                $table->dropIndex('320299_5d19a279a9806');
                $table->dropColumn('crm_status_id');
            }
            if(Schema::hasColumn('crm_customers', 'email')) {
                $table->dropColumn('email');
            }
            if(Schema::hasColumn('crm_customers', 'phone')) {
                $table->dropColumn('phone');
            }
            if(Schema::hasColumn('crm_customers', 'address')) {
                $table->dropColumn('address');
            }
            if(Schema::hasColumn('crm_customers', 'skype')) {
                $table->dropColumn('skype');
            }
            if(Schema::hasColumn('crm_customers', 'website')) {
                $table->dropColumn('website');
            }
            if(Schema::hasColumn('crm_customers', 'description')) {
                $table->dropColumn('description');
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
                        $table->string('last_name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('address')->nullable();
                $table->string('skype')->nullable();
                $table->string('website')->nullable();
                $table->text('description')->nullable();
                
        });

    }
}
