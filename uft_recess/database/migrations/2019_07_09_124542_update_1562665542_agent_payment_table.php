<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562665542AgentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_payments', function (Blueprint $table) {
            if(Schema::hasColumn('agent_payments', 'agent_payments_id')) {
                $table->dropForeign('320301_5d19a28ca94c4');
                $table->dropIndex('320301_5d19a28ca94c4');
                $table->dropColumn('agent_payments_id');
            }
            if(Schema::hasColumn('agent_payments', 'name')) {
                $table->dropColumn('name');
            }
            if(Schema::hasColumn('agent_payments', 'description')) {
                $table->dropColumn('description');
            }
            if(Schema::hasColumn('agent_payments', 'file')) {
                $table->dropColumn('file');
            }
            
        });
Schema::table('agent_payments', function (Blueprint $table) {
            
if (!Schema::hasColumn('agent_payments', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('agent_payments', 'highest_erollment')) {
                $table->decimal('highest_erollment', 15, 2)->nullable();
                }
if (!Schema::hasColumn('agent_payments', 'other_erollments')) {
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
        Schema::table('agent_payments', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('highest_erollment');
            $table->dropColumn('other_erollments');
            
        });
Schema::table('agent_payments', function (Blueprint $table) {
                        $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->string('file')->nullable();
                
        });

    }
}
