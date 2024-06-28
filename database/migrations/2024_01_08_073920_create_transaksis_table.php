<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('jaminan');
            $table->string('foto_jaminan');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->integer('harga');
            $table->integer('denda');
            $table->date('tgl_dikembalikan');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('user_id');
            $table->char('status', 1)->default(0)->comment('0: booking, 1: dipinjam, 2: dikembalikan, 3: batal');
            $table->timestamps();


            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
