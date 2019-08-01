<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1563781856TotalPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(! Schema::hasTable('total_payments')) {
            Schema::create('total_payments', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->decimal('admin', 10, 0)->nullable();
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
        Schema::dropIfExists('total_payments');
    }
}
