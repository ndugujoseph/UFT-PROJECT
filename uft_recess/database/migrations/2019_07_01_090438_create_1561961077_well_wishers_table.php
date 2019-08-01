<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561961077WellWishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('well_wishers')) {
            Schema::create('well_wishers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->decimal('amount',10,0)->nullable();
                $table->date('date')->nullable();
                $table->integer('district_id')->nullable();
                
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
        Schema::dropIfExists('well_wishers');
    }
}
