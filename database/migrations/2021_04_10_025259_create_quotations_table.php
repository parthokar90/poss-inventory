<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->date('quotation_date');
            $table->string('reference_no',100)->nullable();
            $table->unsignedBigInteger('biller_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('tax_id');
            $table->decimal('discount',18,2)->default(0);
            $table->string('shipping',100)->nullable();
            $table->text('notes');
            $table->string('status',50)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
