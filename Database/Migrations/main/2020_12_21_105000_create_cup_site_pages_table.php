<?php

use Gecche\Breeze\Facades\Schema;
use Gecche\Breeze\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCupSitePagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cup_site_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_it')->unique()->nullable();
            $table->string('titolo_it')->nullable();
            $table->longText('content_it')->nullable();
            $table->text('keywords')->nullable();
            $table->boolean('attivo')->default(1);// varchar(50) DEFAULT NULL,
            $table->integer('ordine')->default(0);
            $table->enum('type',['html','news','home','eventi'])->default('html');
            $table->integer('fix')->default(0);
            $table->integer('cup_site_page_id')->unsigned()->index()->nullable();
            $table->foreign('cup_site_page_id')->references('id')->on('cup_site_pages')->onDelete('restrict')->onUpdate('cascade');
            $table->nullableOwnerships();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cup_site_pages');
    }

}
