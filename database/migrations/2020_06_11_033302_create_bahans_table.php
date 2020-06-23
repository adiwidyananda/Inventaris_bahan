<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nama_Bahan');
            $table->integer('Jumlah');
            $table->string('Satuan');
            $table->integer('Harga_Satuan');
            $table->timestamps();
        });

        Schema::table('bahans', function (Blueprint $table) {
            $table->unsignedInteger('id_kategori');
        
            $table->foreign('id_kategori')->references('id')->on('kategoris');
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahans');
    }
}
