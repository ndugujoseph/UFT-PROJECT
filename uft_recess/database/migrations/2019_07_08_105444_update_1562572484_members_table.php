<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562572484MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            if(Schema::hasColumn('members', 'recommender')) {
                $table->dropColumn('recommender');
            }
            
        });
Schema::table('members', function (Blueprint $table) {
            
if (!Schema::hasColumn('members', 'recommender_member')) {
                $table->string('recommender_member')->nullable();
                }
if (!Schema::hasColumn('members', 'date')) {
                $table->date('date')->nullable();
                }
if (!Schema::hasColumn('members', 'member_id')) {
                $table->string('member_id')->nullable();
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
            $table->dropColumn('recommender_member');
            $table->dropColumn('date');
            $table->dropColumn('member_id');
            
        });
Schema::table('members', function (Blueprint $table) {
                        $table->string('recommender')->nullable();
                
        });

    }
}
