<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vendor_type_id');
            $table->string('vendor_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('city');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('country_id');
            $table->string('zipcode', 10);
            $table->string('contact_number');
            $table->string('additional_contact_number');
            $table->string('fax_no');
            $table->integer('discount_days');
            $table->decimal('discount_percentage', 10, 2);
            $table->integer('term_days');
            $table->string('tax_id_no');
            $table->decimal('taxable_amount',10, 2);
            $table->enum('consumer_user_tax', ['yes','no']);
            $table->decimal('balance_owed', 10,2);
            $table->date('date_opened');
            $table->tinyInteger('account_status');
            $table->integer('bank_account_id');
            
            $table->foreign('vendor_type_id')->references('id')->on('vendor_types');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('vendors');
    }
}
