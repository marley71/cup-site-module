<?php

use Illuminate\Database\Migrations\Migration;
use Gecche\Breeze\Database\Schema\Blueprint;

class CreateCupSiteAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cup_site_attachments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nome_it')->nullable();
            $table->string('ext', 6);
            $table->text('descrizione_it')->nullable();
//            $table->string('nome_en')->nullable();
//            $table->text('descrizione_en')->nullable();
//            $table->string('nome_es')->nullable();
//            $table->text('descrizione_es')->nullable();
            $table->boolean('reserved')->nullable();
            $table->integer('ordine')->nullable()->default(0);
            $table->string('mediable_type')->nullable();
            $table->integer('mediable_id')->unsigned()->nullable();
            $table->timestamps();
            $table->nullableOwnerships();
            $table->unique(['mediable_type','mediable_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cup_site_attachments');
	}

}
