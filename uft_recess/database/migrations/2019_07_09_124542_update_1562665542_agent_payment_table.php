<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562665542CrmDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_documents', function (Blueprint $table) {
            if(Schema::hasColumn('crm_documents', 'customer_id')) {
                $table->dropForeign('320301_5d19a28ca94c4');
                $table->dropIndex('320301_5d19a28ca94c4');
                $table->dropColumn('customer_id');
            }
            if(Schema::hasColumn('crm_documents', 'name')) {
                $table->dropColumn('name');
            }
            if(Schema::hasColumn('crm_documents', 'description')) {
                $table->dropColumn('description');
            }
            if(Schema::hasColumn('crm_documents', 'file')) {
                $table->dropColumn('file');
            }
            
        });
Schema::table('crm_documents', function (Blueprint $table) {
            
if (!Schema::hasColumn('crm_documents', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('crm_documents', 'highest_erollment')) {
                $table->decimal('highest_erollment', 15, 2)->nullable();
                }
if (!Schema::hasColumn('crm_documents', 'other_erollments')) {
                $table->decimal('other_erollments', 15, 2)->nullable();
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
        Schema::table('crm_documents', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('highest_erollment');
            $table->dropColumn('other_erollments');
            
        });
Schema::table('crm_documents', function (Blueprint $table) {
                        $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->string('file')->nullable();
                
        });

    }
}
