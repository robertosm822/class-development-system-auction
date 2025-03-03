<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAuctionToAuctionsTable extends Migration
{
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->string('status_auction', 50)->after('auction_end')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->dropColumn('status_auction');
        });
    }
}
