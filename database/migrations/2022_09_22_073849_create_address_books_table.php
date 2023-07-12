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
        Schema::create('address_books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->string('address');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->uuid('customer_id')->nullable();
            $table->foreign('customer_id')->nullable()->references('id')->on('customers');
            $table->uuid('receiver_id')->nullable();
            $table->foreign('receiver_id')->nullable()->references('id')->on('receivers');
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
        Schema::dropIfExists('address_books');
    }
};
