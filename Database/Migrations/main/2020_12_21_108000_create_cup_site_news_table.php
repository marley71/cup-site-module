<?php

use Gecche\Breeze\Facades\Schema;
use Gecche\Breeze\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCupSiteNewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cup_site_news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titolo_it');
            $table->string('menu_it');
            $table->text('descrizione_it');
//            $table->string('titolo_en');
//            $table->text('descrizione_en');
//            $table->string('titolo_es');
//            $table->text('descrizione_es');
            $table->string('tag')->nullable()->default(null);
            $table->dateTime('data');
            $table->dateTime('data_fine')->nullable()->default(null);
            $table->boolean('attivo')->default(true);
            $table->integer('cup_site_page_id')->unsigned()->index()->nullable();
            $table->foreign('cup_site_page_id')->references('id')->on('cup_site_pages')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
            $table->nullableOwnerships();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cup_site_news');
    }

}
