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
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ancient_id')->nullable();
            $table->string('coupon_unique_code')->unique();
            $table->integer('coupon_value');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->date('date_of_use')->nullable();
            $table->boolean('coupon_status')->default(0);
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->nullable()->references('id')->on('users');
            $table->uuid('customer_id')->nullable();
            $table->foreign('customer_id')->nullable()->references('id')->on('customers');
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
        Schema::dropIfExists('coupons');
    }
};
