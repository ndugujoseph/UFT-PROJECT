<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1561967201WellWishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('well_wishers', function (Blueprint $table) {
            if(Schema::hasColumn('well_wishers', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if(Schema::hasColumn('well_wishers', 'agents_id')) {
                $table->dropForeign('320299_5d19a279a9806');
                $table->dropIndex('320299_5d19a279a9806');
                $table->dropColumn('agents_id');
            }
            if(Schema::hasColumn('well_wishers', 'email')) {
                $table->dropColumn('email');
            }
            if(Schema::hasColumn('well_wishers', 'phone')) {
                $table->dropColumn('phone');
            }
            if(Schema::hasColumn('well_wishers', 'address')) {
                $table->dropColumn('address');
            }
            if(Schema::hasColumn('well_wishers', 'skype')) {
                $table->dropColumn('skype');
            }
            if(Schema::hasColumn('well_wishers', 'website')) {
                $table->dropColumn('website');
            }
            if(Schema::hasColumn('well_wishers', 'description')) {
                $table->dropColumn('description');
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
        Schema::table('well_wishers', function (Blueprint $table) {
                        $table->string('last_name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('address')->nullable();
                $table->string('skype')->nullable();
                $table->string('website')->nullable();
                $table->text('description')->nullable();
                
        });

    }
}
