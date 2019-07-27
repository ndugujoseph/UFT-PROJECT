<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1562574633TresuariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('tresuaries')) {
            Schema::create('tresuaries', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->double('amount', 4, 2)->nullable();
                $table->double('total', 4, 2)->nullable();
                
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
        Schema::dropIfExists('tresuaries');
    }
}
