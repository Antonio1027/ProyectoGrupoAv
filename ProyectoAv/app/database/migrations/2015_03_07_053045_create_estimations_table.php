<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstimationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estimations', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->string('costumer_name');
			$table->string('date_event');
			$table->string('event_address');
			$table->string('home_address');
			$table->string('phone');
			$table->string('movil');
			$table->string('email');
			$table->string('date_range');
			$table->string('date_collecting');
			$table->string('type');
			$table->integer('number_people');
			$table->string('color');
			$table->string('rfc');

			$table->float('subtotal');
			$table->float('sub_iva');
			$table->float('deposit');
			$table->float('total');
			$table->float('advanced_payment');
			$table->float('balance');
			$table->integer('discount');

			$table->boolean('iva')->default(false);
			$table->boolean('buffete')->default(false);

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
		Schema::drop('estimations');
	}

}
