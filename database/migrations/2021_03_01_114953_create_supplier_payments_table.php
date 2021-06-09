<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_invoice_id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('payment_date');
            $table->decimal('total_purchase',18,2);
            $table->decimal('total_payment',18,2);
            $table->decimal('total_due',18,2);
            $table->decimal('payment_amount',18,2);
            $table->unsignedBigInteger('payment_by');
            $table->string('bkash_trx_id')->nullable();
            $table->string('bkash_acc_no')->nullable();
            $table->string('bkash_payment_amount')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->string('bank_payment_amount')->nullable();
            $table->string('payment_method');
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
        Schema::dropIfExists('supplier_payments');
    }
}
