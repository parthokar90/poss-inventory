<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('biller_id')->nullable();
            $table->date('sale_date');
            $table->string('sale_vat')->nullable();
            $table->string('sale_vat_amount')->nullable();
            $table->string('sale_discount')->nullable();
            $table->string('sale_discount_amount')->nullable();
            $table->text('sale_note')->nullable();
            $table->unsignedBigInteger('sale_by');
            $table->string('sale_total_price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('total_payment')->nullable();
            $table->string('total_due')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('sales');
    }
}
