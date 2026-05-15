<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemprarySaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temprary_sale_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('warehouse')->nullable();
            $table->bigInteger('warehouse_id')->nullable();
            $table->string('stock_qty')->nullable();
            $table->string('input_qty')->nullable();
            $table->string('product')->nullable();
            $table->string('product_price')->nullable();
            $table->string('code')->nullable();
            $table->string('cost')->nullable();
            $table->string('tax_rate_id')->nullable();
            $table->string('tax_rate_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('varient_id')->nullable();
            $table->string('varient')->nullable();
            $table->string('varient_price')->nullable();
            $table->string('ac_price')->nullable();
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
        Schema::dropIfExists('temprary_sale_items');
    }
}
