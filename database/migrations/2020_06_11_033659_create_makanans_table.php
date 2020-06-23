<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makanans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nama_Makanan');
            $table->integer('Harga');
            $table->date('Tanggal_Keluar');
            $table->timestamps();
        });

        Schema::table('makanans', function (Blueprint $table) {
            $table->unsignedInteger('id_admin');
        
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
        Schema::dropIfExists('makanans');
    }
}
