<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annoucements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("seller_id");
            $table->string("title");
            $table->string("product_buyer_premium");
            $table->string("product_bid_increment");
            $table->string("product_attribute_condition");
            $table->string("product_attribute_mileage");
            $table->string("product_attribute_year_fabric");
            $table->string("product_attribute_engine");
            $table->string("product_attribute_fuel");
            $table->string("product_attribute_transmission");
            $table->string("product_number_doors");
            $table->string("product_color");
            $table->text("description");
            $table->date("date_expiration");
            $table->string("status")->default('active'); //"string (active | inactive)",
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annoucements');
    }
};
