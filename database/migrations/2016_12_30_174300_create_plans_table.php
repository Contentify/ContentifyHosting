<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->decimal('amount', 6, 2);
            $table->enum('interval', ['day', 'week', 'month', 'year']);
            $table->integer('interval_count')->nullable();
            $table->text('description');
            $table->integer('trial')->nullable();
            $table->boolean('published')->default(0);
            $table->uuid('uid');
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
        Schema::dropIfExists('plans');
    }
}
