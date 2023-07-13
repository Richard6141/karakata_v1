<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('age');
            $table->string('sexe');
            $table->string('location');
            $table->string('profession');
            $table->boolean('online_payment');
            $table->string('why_not_paid');
            $table->string('which_product');
            $table->string('payment_frequency');
            $table->json('payment_obstacles');
            $table->string('payment_method')->nullable();
            $table->boolean('choose_product_by_home_delivery');
            $table->boolean('use_delivery_service');
            $table->boolean('delivery_cost_influence_shop');
            $table->string('free_delivery_all_product');
            $table->string('improve_free_delivery');
            $table->string('online_payment_advantage');
            $table->string('online_payment_defi');
            $table->text('yes_online_payment_if_resolve');
            $table->string('which_improvment_fonctionality');
            $table->integer('phone')->nullable();
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
        Schema::dropIfExists('surveys');
    }
};
