<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTipeToProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('tipe')->after('merk');
            $table->string('warna')->after('tipe');
            $table->year('tahun')->after('warna');
            $table->text('feature')->after('tahun');
            $table->text('keterangan')->after('feature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['tipe', 'warna', 'tahun', 'feature', 'keterangan']);
        });
    }
}
