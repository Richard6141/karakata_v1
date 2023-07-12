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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->string('observation');
            $table->date('date_of_delivery');
            $table->boolean('delivery_status')->default(0)->change();
            $table->uuid('order_id')->nullable();
            $table->foreign('order_id')->nullable()->references('id')->on('orders');
            $table->uuid('delivery_id')->nullable();
            $table->foreign('delivery_id')->nullable()->references('id')->on('users');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
};
