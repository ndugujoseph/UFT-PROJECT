<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TotalPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(! Schema::hasTable('total_payment')) {
            Schema::create('total_payment', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->decimal('agent_low', 10, 0)->nullable();
                $table->decimal('agent_high', 10, 0)->nullable();
                $table->decimal('agent_head_low', 10, 0)->nullable();
                $table->decimal('agent_head_high', 10, 0)->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('total_payment');
    }
}
