<?php

use Grupoav\Entities\Estimation;
use Grupoav\Entities\Order;
use Grupoav\Entities\Payment;

use Faker\Factory as Faker;

class EstimationsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('es-Es');

		foreach(range(1, 10) as $key => $index)
		{
			$estimation = Estimation::create([
				"costumer_name" => $faker->name,
				"date_event" => '2015'.'-0'.$faker->numberBetween($min = 1, $max = 9).'-0'.$faker->numberBetween($min = 1, $max = 9), // '1979-06-09',
				"event_address" => $faker->address,
				"home_address" => $faker->address,
				"phone" => $faker->phoneNumber,
				"movil" => $faker->phoneNumber,
				"email" => $faker->email,
				"date_range" => '2015'.'-0'.$faker->numberBetween($min = 1, $max = 9).'-0'.$faker->numberBetween($min = 1, $max = 9),
				"date_collecting" => '2015'.'-0'.$faker->numberBetween($min = 1, $max = 9).'-0'.$faker->numberBetween($min = 1, $max = 9),
				"type" => $faker->randomElement(['Coffe','Boda','Cumpleaños','Quince años','Bautizo']),
				"number_people" => $faker->numberBetween($min = 10, $max = 300),
				"color" => $faker->randomElement(['Blanco','Negro','Azul','Amarillo','Rojo']),				
				"subtotal" => "1200",
				"deposit" => "300",
				"total" => "500",
				"advanced_payment" => "600",
				"balance" => "1100",
				"discount" => "1"
			]);			

			foreach(range(1, 5) as $index)
			{
				$pivot = [
					"estimation_id" => $estimation->id,
					"type_id" => $faker->numberBetween($min = 1, $max = 46),
					"quantity" => $faker->numberBetween($min = 1, $max = 10)
				];
				DB::table('estimation_type')->insert($pivot);
			}

			if($key % 2){
				$order = Order::create([
						"available_facture" => $faker->randomElement([1,0]),
						"status" => $faker->randomElement([0,1,2]),
						"estimation_id" => $estimation->id
					]);
				foreach (range(1, $faker->numberBetween($min = 2, $max = 4)) as $key => $value) {
					Payment::create([
						"amount" => $faker->randomFloat($nbMaxDecimals = 2, $min = 1000.00, $max = 12000.00),
						"description" => $faker->sentence($nbWords = 6),
						"number" => $key + 1,
						"order_id" => $order->id
					]);
				}
			}			
		}
	}

}