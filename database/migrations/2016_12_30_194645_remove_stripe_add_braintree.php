<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveStripeAddBraintree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('braintree_id')->nullable();
            $table->string('paypal_email')->nullable();
            $table->dropColumn('stripe_id');
        });

        Schema::table('subscriptions', function ($table) {
            $table->string('braintree_id');
            $table->string('braintree_plan');
            $table->dropColumn(['stripe_id', 'stripe_plan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
