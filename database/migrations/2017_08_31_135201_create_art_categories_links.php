<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtCategoriesLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art_categories_link', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('art_id')->unsigned()->index();
            $table->foreign('art_id')->references('id')->on('arts')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('art_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table("art_categories_link",
             function($table) {
                 $table->dropForeign('art_id');
                 $table->dropForeign('category_id');
         });
        Schema::dropIfExists('categories_links_table');
    }
}
