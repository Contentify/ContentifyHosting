<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('tags', 255);
            $table->string('ip', 40)->nullable();
            $table->text('description');
            $table->string('user_id')->index();
            $table->integer('provider_id')->index();
            $table->integer('datacenter_id')->index();
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
        Schema::dropIfExists('servers');
    }
}
