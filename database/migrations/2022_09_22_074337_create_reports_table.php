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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->string('date');
            $table->string('start_time');
            $table->string('hour_end');
            $table->string('order_day')->nullable();
            $table->string('venue')->nullable();
            $table->string('attendees');
            $table->string('content');
            $table->string('approved')->nullable();
            $table->uuid('document_type_id')->nullable();
            $table->foreign('document_type_id')->nullable()->references('id')->on('document_types');
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
        Schema::dropIfExists('reports');
    }
};
