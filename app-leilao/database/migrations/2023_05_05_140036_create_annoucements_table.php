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
            $table->unsignedBigInteger("category_id");
            $table->string("title");
            $table->string("product_bid_increment");
            $table->string("product_attribute_condition")->nullable();
            $table->string("product_attribute_mileage")->nullable();
            $table->string("product_attribute_year_fabric")->nullable();
            $table->string("product_attribute_engine")->nullable();
            $table->string("product_attribute_fuel")->nullable();
            $table->string("product_attribute_transmission")->nullable();
            $table->string("product_number_doors")->nullable();
            $table->double("current_price")->default(0.00);
            $table->string("product_color")->nullable();
            $table->string("define_favorite")->default('0');
            $table->text("description");
            $table->dateTime("date_started")->default(date('Y-m-d H:i:s'));
            $table->dateTime("date_expiration");
            $table->string("status")->default('active'); //"string (active | inactive)",
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories');
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
