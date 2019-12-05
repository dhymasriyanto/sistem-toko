<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debt_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_faktur');
            $table->date('tanggal_transaksi');
            $table->date('tenggat_hutang');
            $table->integer('total');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_transactions');
    }
}
