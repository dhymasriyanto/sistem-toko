<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToDetailDebtTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_debt_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_transaksi')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('stuffs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_debt_transactions', function (Blueprint $table) {
            $table->dropForeign('id_transaksi');
            $table->dropForeign('id_barang');
        });
    }
}
