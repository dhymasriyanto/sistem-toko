<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToDebtors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debtors', function (Blueprint $table) {
//            $table->date('tanggal_transaksi');
//            $table->date('tenggat_hutang');
//            $table->foreign('tanggal_transaksi')->references('tanggal_transaksi')->on('debt_transactions')->onDelete('cascade');
//            $table->foreign('tenggat_hutang')->references('tenggat_hutang')->on('debt_transactions')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debtors', function (Blueprint $table) {
//            $table->dropForeign('tanggal_transaksi');
//            $table->dropForeign('tenggat_hutang');
        });
    }
}
