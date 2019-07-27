<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1562571936DistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
            if(Schema::hasColumn('districts', 'full_name')) {
                $table->dropColumn('full_name');
            }
            if(Schema::hasColumn('districts', 'email')) {
                $table->dropColumn('email');
            }
            if(Schema::hasColumn('districts', 'username')) {
                $table->dropColumn('username');
            }
            if(Schema::hasColumn('districts', 'dateofbirth')) {
                $table->dropColumn('dateofbirth');
            }
            if(Schema::hasColumn('districts', 'district')) {
                $table->dropColumn('district');
            }
            if(Schema::hasColumn('districts', 'signature')) {
                $table->dropColumn('signature');
            }
            if(Schema::hasColumn('districts', 'password')) {
                $table->dropColumn('password');
            }
            if(Schema::hasColumn('districts', 'gender')) {
                $table->dropColumn('gender');
            }
            
        });
Schema::table('districts', function (Blueprint $table) {
            
if (!Schema::hasColumn('districts', 'name')) {
                $table->string('name')->nullable();
                }
if (!Schema::hasColumn('districts', 'initials')) {
                $table->string('initials')->nullable();
                }
if (!Schema::hasColumn('districts', 'region')) {
                $table->string('region')->nullable();
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
        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('initials');
            $table->dropColumn('region');
            
        });
Schema::table('districts', function (Blueprint $table) {
                        $table->string('full_name')->nullable();
                $table->string('email')->nullable();
                $table->string('username')->nullable();
                $table->date('dateofbirth')->nullable();
                $table->string('district')->nullable();
                $table->string('signature')->nullable();
                $table->string('password')->nullable();
                $table->enum('gender', array('&#039;M&#039;', '&#039;F&#039;'))->nullable();
                
        });

    }
}
