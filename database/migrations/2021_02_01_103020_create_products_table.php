<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_type',50)->nullable();
            $table->string('product_name',50)->nullable();
            $table->string('product_code',50)->nullable();
            $table->string('product_slug',50)->nullable();
            $table->string('product_cost',50)->nullable();
            $table->decimal('product_price',18,2)->nullable();
            $table->string('product_alert_qty',50)->nullable();
            $table->string('product_weight',50)->nullable();
            $table->string('product_image',255)->nullable();
            $table->string('product_qty')->nullable();
            $table->unsignedBigInteger('tax_rate_id')->nullable();
            $table->unsignedBigInteger('product_brand')->nullable();
            $table->unsignedBigInteger('product_cat_id')->nullable();
            $table->unsignedBigInteger('product_subcat_id')->nullable();
            $table->unsignedBigInteger('product_unit_id')->nullable();
            $table->text('product_details')->nullable();
            $table->text('product_details_invoice')->nullable();
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
        Schema::dropIfExists('products');
    }
}
