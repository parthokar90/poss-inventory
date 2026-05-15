<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->date('purchase_date')->nullable();
            $table->unsignedBigInteger('purchased_by');
            $table->bigInteger('warehouse_id')->nullable();
            $table->string('warehouse')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('product')->nullable();
            $table->string('product_price')->nullable();
            $table->string('code')->nullable();
            $table->string('cost')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_rate_id')->nullable();
            $table->string('tax_rate_type')->nullable();
            $table->string('varient_id')->nullable();
            $table->string('varient')->nullable();
            $table->string('varient_price')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('sub_total')->nullable();
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
        Schema::dropIfExists('purchase_items');
    }
}
