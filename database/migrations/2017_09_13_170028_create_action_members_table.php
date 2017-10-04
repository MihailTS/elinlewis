<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('promo_id')->unsigned()->nullable()->index();
            $table->foreign('promo_id')->references('id')->on('promocodes')->onDelete('cascade');
            $table->string('vk')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('action_members');
    }
}
