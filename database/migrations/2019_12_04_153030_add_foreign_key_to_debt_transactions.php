<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToDebtTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debt_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('id_penghutang');
            $table->foreign('id_karyawan')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_penghutang')->references('id')->on('debtors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debt_transactions', function (Blueprint $table) {
            $table->dropForeign('id_karyawan');
            $table->dropForeign('id_penghutang');
        });
    }
}
