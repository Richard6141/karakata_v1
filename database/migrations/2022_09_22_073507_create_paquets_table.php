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
        Schema::create('paquets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->string('label')->nullable();
            $table->date('date')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('price');
            $table->string('image')->nullable();
            $table->uuid('paquet_type_id');
            $table->foreign('paquet_type_id')->nullable()->references('id')->on('paquet_types');
            $table->text('component_type_id')->nullable();
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
        Schema::dropIfExists('paquets');
    }
};
