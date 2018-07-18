<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_type_id');
            $table->string('bank_name');
            $table->string('account_no');
            $table->string('account_holder');
            $table->string('branch_name');
            $table->string('micr_code');
            $table->string('ifsc_code');
            $table->text('bank_address');
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
        Schema::dropIfExists('bank_account_details');
    }
}
