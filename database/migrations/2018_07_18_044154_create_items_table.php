<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_type_id');
            $table->unsignedInteger('item_category_id');
            $table->unsignedInteger('vendor_id');
            $table->string('item_name');
            $table->string('item_code');
            $table->string('item_image');
            $table->text('item_description');

            $table->foreign('item_type_id')->references('id')->on('item_types');
            $table->foreign('item_category_id')->references('id')->on('item_categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');

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
        Schema::dropIfExists('items');
    }
}
