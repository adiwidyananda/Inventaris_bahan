<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Jumlah');
            $table->date('Tanggal_Masuk');
            $table->integer('Harga');
            $table->timestamps();
        });

        Schema::table('bahan_masuks', function (Blueprint $table) {
            $table->unsignedInteger('id_bahan');
            $table->unsignedInteger('id_admin');
        
            $table->foreign('id_bahan')->references('id')->on('bahans');
            $table->foreign('id_admin')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_masuks');
    }
}
