<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561961087AgentheadPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('agent_head_payments')) {
            Schema::create('agent_head_payments', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->decimal('highest_erollment',10,0)->nullable();
                $table->decimal('lowest_erollment',10,0)->nullable();

                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_head_payments');
    }
}
