<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name',100)->nullable();
            $table->string('company_email',100)->nullable();
            $table->string('company_phone',100)->nullable();
            $table->string('company_logo',255)->nullable();
            $table->string('company_address',100)->nullable();
            $table->string('country',100)->nullable();
            $table->string('company_city',100)->nullable();
            $table->string('company_state',100)->nullable();
            $table->string('company_postcode',100)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
