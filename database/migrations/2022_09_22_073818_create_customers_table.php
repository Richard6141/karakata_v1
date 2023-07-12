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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->uuid('particulars_id')->nullable();
            $table->foreign('particulars_id')->nullable()->references('id')->on('particulars');
            $table->uuid('companies_id')->nullable();
            $table->foreign('companies_id')->nullable()->references('id')->on('companies');
            $table->string('username')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('status')->nullable();
            $table->string('email')->nullable();
            $table->integer('solde')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
