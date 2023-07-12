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
        Schema::create('quotas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->integer('quota')->default(0);
            $table->integer('quota_courant')->default(0);
            $table->uuid('resistance_id');
            $table->foreign('resistance_id')->references('id')->on('components');
            $table->date('date');
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
        Schema::dropIfExists('quotas');
    }
};
