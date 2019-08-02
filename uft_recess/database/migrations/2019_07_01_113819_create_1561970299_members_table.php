<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1561970299MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('members')) {
            Schema::create('members', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('district')->nullable();
                $table->string('recommender_agent')->nullable();
                $table->string('recommender_member')->nullable();
                $table->date('date')->nullable();
                $table->string('member_id')->nullable();
                $table->string('gender')->nullable();
                $table->integer('recommendees')->nullable();
                
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
        Schema::dropIfExists('members');
    }
}
