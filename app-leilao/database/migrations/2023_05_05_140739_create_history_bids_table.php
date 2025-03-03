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
        Schema::create('history_bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("seller_id");
            $table->unsignedBigInteger("announcement_id");
            $table->unsignedBigInteger("particiopant_id");
            $table->double("price_initial")->default(0);
            $table->double("price_incremental")->default(0);
            $table->double("price_now_bid", 12, 2)->default(0);
            $table->string("time_expiration");
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->foreign('announcement_id')->references('id')->on('annoucements');
            $table->foreign('particiopant_id')->references('id')->on('particiopants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_bids');
    }
};
