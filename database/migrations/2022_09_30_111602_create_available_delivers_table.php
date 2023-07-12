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
        Schema::create('available_delivers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->uuid('deliver_id');
            $table->foreign('deliver_id')->nullable()->references('id')->on('delivers');
            $table->string('start_day');
            $table->string('end_day');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('available_delivers');
    }
};
