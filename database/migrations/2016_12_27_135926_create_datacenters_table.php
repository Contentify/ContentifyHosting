<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatacentersTable extends Migration {

	public function up()
	{
		Schema::create('datacenters', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('code', 255);
			$table->text('description');
			$table->string('provider_id', 255)->index();
			$table->string('country_id', 255)->index();
			$table->boolean('published')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('datacenters');
	}
}