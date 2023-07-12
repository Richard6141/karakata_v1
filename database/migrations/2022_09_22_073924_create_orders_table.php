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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->date('date');
            $table->integer('number');
            $table->integer('total');
            $table->integer('unit_price');
            $table->text('more_information')->nullable();
            $table->boolean('is_delete')->default(false);
            $table->integer('slip_number');
            $table->string('customer_delivery_time')->nullable();
            $table->string('delivery_time')->nullable();
            $table->boolean('status_order')->default(false);  // Valider // En c
            $table->boolean('status_delivery')->default(false);  // Valider // En c
            $table->boolean('finished')->default(false);  // Valider // En c
            $table->uuid('paquet_id')->nullable();
            $table->foreign('paquet_id')->nullable()->references('id')->on('paquets');
            $table->uuid('address_book_id')->nullable();
            $table->foreign('address_book_id')->nullable()->references('id')->on('address_books');
            $table->uuid('source_id')->nullable();
            $table->foreign('source_id')->nullable()->references('id')->on('sources');
            $table->uuid('order_type_id')->nullable();
            $table->foreign('order_type_id')->nullable()->references('id')->on('order_types');
            $table->uuid('payement_mode_id')->nullable();
            $table->foreign('payement_mode_id')->nullable()->references('id')->on('payement_modes');
            $table->uuid('customer_id')->nullable();
            $table->foreign('customer_id')->nullable()->references('id')->on('customers');
            $table->uuid('district_id')->nullable();
            $table->foreign('district_id')->nullable()->references('id')->on('districts');
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->nullable()->references('id')->on('users');
            $table->uuid('receiver_id')->nullable();
            $table->foreign('receiver_id')->nullable()->references('id')->on('receivers');
            $table->uuid('deliver_id')->nullable();
            $table->foreign('deliver_id')->nullable()->references('id')->on('delivers');
            $table->uuid('contain_id')->nullable();
            $table->foreign('contain_id')->nullable()->references('id')->on('contains');
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
        Schema::dropIfExists('orders');
    }
};
