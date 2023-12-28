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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("seller_id");
            $table->unsignedBigInteger("announcement_id");
            $table->double("price_initial")->default(0);
            $table->double("price_incremental")->default(0);
            $table->double("price_now_bid", 12,2)->default(0);
            $table->string("time_expiration");
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('announcement_id')->references('id')->on('annoucements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
};
