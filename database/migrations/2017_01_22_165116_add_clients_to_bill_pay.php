<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientsToBillPay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills_pay', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills_pay', function (Blueprint $table) {
            $table->dropForeign('bills_pay_client_id_foreign');
            $table->dropColumn('client_id');
        });
    }
}
