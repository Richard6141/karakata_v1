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
        Schema::create('customer_depots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->integer('amount');
            $table->string('date');
            $table->string('type')->default('Depot');
            $table->foreign('customer_id')->nullable()->references('id')->on('customers');
            $table->uuid('customer_id')->nullable();
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
        Schema::dropIfExists('customer_depots');
    }
};
