<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->enum('category', ['Grafis & Desain', 'Teknologi & Pemrograman', 'Musik & Audio', 'Tulisan & Terjemahan', 'Video & Animasi'])->nullable();
            $table->string('service_name')->nullable();
            $table->string('shop_description')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_invoice')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
