<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561962516DistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('districts')) {
            Schema::create('districts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('full_name')->nullable();
                $table->string('email')->nullable();
                $table->string('username')->nullable();
                $table->date('dateofbirth')->nullable();
                $table->string('district')->nullable();
                $table->string('signature')->nullable();
                $table->string('password')->nullable();
                $table->enum('gender', array('&#039;M&#039;', '&#039;F&#039;'))->nullable();
                
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
        Schema::dropIfExists('districts');
    }
}
