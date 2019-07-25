<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561961096AgentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('agent_payments')) {
            Schema::create('agent_payments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->string('file')->nullable();
                
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
        Schema::dropIfExists('agent_payments');
    }
}
