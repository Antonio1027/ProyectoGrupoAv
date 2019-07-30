<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstimationTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estimation_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('quantity')->unsigned();
			$table->integer('estimation_id')->unsigned()->index();
			$table->foreign('estimation_id')->references('id')->on('estimations')->onDelete('cascade');
			$table->integer('type_id')->unsigned()->index();
			$table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
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
		Schema::drop('estimation_type');
	}

}
