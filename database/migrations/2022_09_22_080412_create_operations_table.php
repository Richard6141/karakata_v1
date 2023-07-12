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
        Schema::create('operations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->uuid('product_id');
            $table->foreign('product_id')->nullable()->references('id')->on('products');
            $table->uuid('operation_type_id')->nullable();
            $table->foreign('operation_type_id')->nullable()->references('id')->on('operation_types');
            $table->integer('quantity');
            $table->integer('price')->nullable();
            $table->string('label');
            $table->string('observation');
            $table->integer('theoricquantity');
            $table->date('date_operation');
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
        Schema::dropIfExists('operations');
    }
};
