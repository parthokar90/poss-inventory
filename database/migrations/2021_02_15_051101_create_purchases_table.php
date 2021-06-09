<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->date('purchase_date');
            $table->string('purchase_vat')->nullable();
            $table->string('purchase_vat_amount')->nullable();
            $table->string('purchase_discount')->nullable();
            $table->string('purchase_discount_amount')->nullable();
            $table->text('purchase_note')->nullable();
            $table->unsignedBigInteger('purchased_by');
            $table->string('order_total_price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('total_payment')->nullable();
            $table->string('total_due')->nullable();
            $table->string('status');
            $table->string('payment_status');
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
        Schema::dropIfExists('purchases');
    }
}
