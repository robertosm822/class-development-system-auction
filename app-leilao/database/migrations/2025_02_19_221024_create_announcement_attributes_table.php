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
        Schema::create('announcement_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')
                ->constrained('announcements')
                ->onDelete('cascade');
            $table->string('attribute_name'); // Nome do atributo (ex: "Tamanho", "Cor", "Material")
            $table->string('attribute_value'); // Valor do atributo (ex: "42", "Azul", "Algodão")
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
        Schema::table('announcement_attributes', function (Blueprint $table) {
            //
        });
    }
};
