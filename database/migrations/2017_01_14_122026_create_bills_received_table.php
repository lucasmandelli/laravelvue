<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsReceivedTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills_received', function(Blueprint $table) {
            $table->increments('id');

            $table->dateTime('date_due');
            $table->string('name');
            $table->decimal('value', 14, 2);
            $table->boolean('done', 14, 2)->default(false);

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
		Schema::drop('bills_received');
	}

}
