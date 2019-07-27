<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562664711AgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            if(Schema::hasColumn('agents', 'title')) {
                $table->dropColumn('title');
            }
            
        });
Schema::table('agents', function (Blueprint $table) {
            
if (!Schema::hasColumn('agents', 'full_name')) {
                $table->string('full_name')->nullable();
                }
if (!Schema::hasColumn('agents', 'username')) {
                $table->string('username')->nullable();
                }
if (!Schema::hasColumn('agents', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
                }
if (!Schema::hasColumn('agents', 'email')) {
                $table->string('email')->nullable();
                }
if (!Schema::hasColumn('agents', 'gender')) {
                $table->string('gender')->nullable();
                }
if (!Schema::hasColumn('agents', 'signature')) {
                $table->string('signature')->nullable();
                }
if (!Schema::hasColumn('agents', 'password')) {
                $table->string('password')->nullable();
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
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('full_name');
            $table->dropColumn('username');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('email');
            $table->dropColumn('gender');
            $table->dropColumn('signature');
            $table->dropColumn('password');
            
        });
Schema::table('agents', function (Blueprint $table) {
                        $table->string('title');
                
        });

    }
}
