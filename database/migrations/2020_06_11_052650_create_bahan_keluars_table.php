<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_keluars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Jumlah');
            $table->integer('Harga_Total');
            $table->date('Tanggal_Keluar');
            $table->timestamps();
        });

        Schema::table('bahan_keluars', function (Blueprint $table) {
            $table->unsignedInteger('id_bahan');
            $table->unsignedInteger('id_makanan');
        
            $table->foreign('id_bahan')->references('id')->on('bahans');
            $table->foreign('id_makanan')->references('id')->on('makanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_keluars');
    }
}
