<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name',100)->nullable();
            $table->string('customer_phone',100)->nullable();
            $table->string('customer_email',100)->nullable();
            $table->text('customer_address')->nullable();
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('postcode',100)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
