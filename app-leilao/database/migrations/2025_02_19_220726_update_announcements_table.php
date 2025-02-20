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
        Schema::table('annoucements', function (Blueprint $table) {
            // Removendo colunas específicas para veículos
            $table->dropColumn([
                'product_bid_increment',
                'product_attribute_mileage',
                'product_attribute_year_fabric',
                'product_attribute_engine',
                'product_attribute_fuel',
                'product_attribute_transmission',
                'product_number_doors',
                'product_color'
            ]);

            // Adicionando novo campo genérico para condição do produto
            $table->string('condition')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            //
        });
    }
};
