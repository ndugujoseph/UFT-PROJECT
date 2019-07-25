<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562572202MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            if(Schema::hasColumn('members', 'payments')) {
                $table->dropColumn('payments');
            }
            if(Schema::hasColumn('members', 'erollment')) {
                $table->dropColumn('erollment');
            }
            
        });
Schema::table('members', function (Blueprint $table) {
            
if (!Schema::hasColumn('members', 'name')) {
                $table->string('name')->nullable();
                }
if (!Schema::hasColumn('members', 'district')) {
                $table->string('district')->nullable();
                }
if (!Schema::hasColumn('members', 'recommender_agent')) {
                $table->string('recommender_agent')->nullable();
                }
if (!Schema::hasColumn('members', 'recommender')) {
                $table->string('recommender')->nullable();
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
            $table->dropColumn('name');
            $table->dropColumn('district');
            $table->dropColumn('recommender_agent');
            $table->dropColumn('recommender');
            
        });
Schema::table('members', function (Blueprint $table) {
                        $table->string('payments')->nullable();
                $table->string('erollment')->nullable();
                
        });

    }
}
