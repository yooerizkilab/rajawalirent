<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTransmisiToProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->integer('jarak_tempuh')->after('tahun');
            $table->string('transmisi')->after('jarak_tempuh');
            $table->integer('tempat_duduk')->after('transmisi');
            $table->integer('bagasi')->after('tempat_duduk');
            $table->string('bbm')->after('bagasi');
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
            $table->dropColumn(['jarak_tempuh', 'transmisi', 'tempat_duduk', 'bagasi', 'bbm']);
        });
    }
}
