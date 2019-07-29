<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1563017324TresuariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tresuaries', function (Blueprint $table) {
            if(Schema::hasColumn('tresuaries', 'date')) {
                $table->dropColumn('date');
            }
            if(Schema::hasColumn('tresuaries', 'amount')) {
                $table->dropColumn('amount');
            }
            if(Schema::hasColumn('tresuaries', 'total')) {
                $table->dropColumn('total');
            }
            
        });
Schema::table('tresuaries', function (Blueprint $table) {
            
if (!Schema::hasColumn('tresuaries', 'da')) {
                $table->string('da')->nullable();
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
        Schema::table('tresuaries', function (Blueprint $table) {
            $table->dropColumn('da');
            
        });
Schema::table('tresuaries', function (Blueprint $table) {
                        $table->date('date')->nullable();
                $table->double('amount', 4, 2)->nullable();
                $table->double('total', 4, 2)->nullable();
                
        });

    }
}
