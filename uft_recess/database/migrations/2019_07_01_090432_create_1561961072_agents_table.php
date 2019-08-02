<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561961072AgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('agents')) {
            Schema::create('agents', function (Blueprint $table) {
                 $table->increments('id');
                $table->string('full_name');
                $table->string('username')->unique();;
                $table->date('date_of_birth')->nullable();
                $table->string('email')->unique();;
                $table->enum('gender',['M','F']);
                $table->string('signature');
                $table->string('password');
                $table->integer('role')->nullable();
                $table->integer('district')->nullable();
                
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
        Schema::dropIfExists('agents');
    }
}
