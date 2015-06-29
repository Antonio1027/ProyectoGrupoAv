<?php
use Grupoav\Entities\User;
// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		User::create([
				'name'		=> 'grupoav',
				'email'		=> 'grupoav@hotmail.com',
				'username'  => 'grupoav.admin',
				'password'	=> '123',
				'movil'		=> '961 123 44 32',
				'type' 		=> 'administrador'
		]);

		// foreach(range(1, 10) as $index)
		// {
		// 	User::create([
		// 		'name'		=> $faker->name,
		// 		'email'		=> $faker->email,
		// 		'username'  => $faker->userName,
		// 		'password'	=> '123',
		// 		'movil'		=> $faker->phoneNumber,
		// 		'type' 		=> $faker->randomElement(['usuario','administrador'])
		// 	]);
		// }
	}

}