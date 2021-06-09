<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_amounts', function (Blueprint $table) {
            $table->id();
            $table->date('expense_date');
            $table->string('expense_amount',100);
            $table->unsignedBigInteger('category_id');
            $table->bigInteger('warehouse_id')->unsigned();
            $table->text('note')->nullable();
            $table->string('attachment',255)->nullable();
            $table->bigInteger('created_by');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('expense_amounts');
    }
}
