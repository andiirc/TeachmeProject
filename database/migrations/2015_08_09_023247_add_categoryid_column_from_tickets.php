<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryidColumnFromTickets extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('ticket_categories');

            //$table->unique(['user_id','title','category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {

            $table->dropForeign('tickets_category_id_foreign');
            $table->dropColumn('category_id');
            //$table->dropUnique('tickets_user_id_unique');
            //$table->dropUnique('tickets_title_unique');
            //$table->dropIndex('category_id');


        });
    }
}
