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
        Schema::create('contains', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->uuid('component_type_id');
            $table->foreign('component_type_id')->nullable()->references('id')->on('component_types');
            $table->uuid('component_id');
            $table->foreign('component_id')->references('id')->on('components');
            $table->uuid('paquet_id');
            $table->foreign('paquet_id')->references('id')->on('paquets');
            $table->date('date');
            $table->integer('price')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('contains');
    }
};
