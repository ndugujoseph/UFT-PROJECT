<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562665345AgentHeadPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_head_payment', function (Blueprint $table) {
            if(Schema::hasColumn('agent_head_payment', 'well_wishers_id')) {
                $table->dropForeign('320300_5d19a2837cdc2');
                $table->dropIndex('320300_5d19a2837cdc2');
                $table->dropColumn('well_wishers_id');
            }
            if(Schema::hasColumn('agent_head_payment', 'note')) {
                $table->dropColumn('note');
            }
            
        });
Schema::table('agent_head_payment', function (Blueprint $table) {
            
if (!Schema::hasColumn('agent_head_payment', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('agent_head_payment', 'highest_erollment')) {
                $table->decimal('highest_erollment', 15, 2)->nullable();
                }
if (!Schema::hasColumn('agent_head_payment', 'lowest_erollment')) {
                $table->decimal('lowest_erollment', 15, 2)->nullable();
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
        Schema::table('agent_head_payment', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('highest_erollment');
            $table->dropColumn('lowest_erollment');
            
        });
Schema::table('agent_head_payment', function (Blueprint $table) {
                        $table->text('note')->nullable();
                
        });

    }
}
