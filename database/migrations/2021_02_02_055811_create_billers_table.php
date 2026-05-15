<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billers', function (Blueprint $table) {
            $table->id();
            $table->string('company',100)->nullable();
            $table->string('logo',255)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('vat_no',100)->nullable();
            $table->string('gst_no',100)->nullable();
            $table->string('postcode',100)->nullable();
            $table->string('country',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('billers');
    }
}
