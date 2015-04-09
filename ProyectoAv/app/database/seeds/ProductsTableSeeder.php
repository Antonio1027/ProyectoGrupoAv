<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Grupoav\Entities\Product;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder {

	public function run()
	{		
		
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Carpas',
			'type'=>'Sencilla'
		]);	
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Carpas',
			'type'=>'Arabe'
		]);	
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Otros',
			'type'=>'Sillones'
		]);			
		// -------------------------Otros
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Otros',
			'type'=>'Cubos'
		]);	
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Otros',
			'type'=>'Cilindros'
		]);	
		// ---------------------------Mesas
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Iluminada'
		]);	
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Periquera'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Tablon hotelero'
		]);	
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Bufet (stand)'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Redondas'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Imperial'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mesas',
			'type'=>'Buffet'
		]);
		// ---------------------------Sillas
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Sillas',
			'type'=>'Periqueras'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Sillas',
			'type'=>'Acojinadas'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Sillas',
			'type'=>'Metálicas'
		]);		
		// --------------------------Sillas Tiffany
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Sillas tiffany',
			'type'=>'uno'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Sillas tiffany',
			'type'=>'dos'
		]);
		// --------------------------Cojines
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cojines',
			'type'=>'uno'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cojines',
			'type'=>'dos'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cojines',
			'type'=>'tres'
		]);
		// --------------------------Mantel Redondo
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mantel redondo',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mantel redondo',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mantel redondo',
			'type'=>'blanco'
		]);
		// ---------------------------Cubre Mantel Redondo
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre mantel redondo',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre mantel redondo',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre mantel redondo',
			'type'=>'blanco'
		]);
		// ---------------------------------Mantel rectangular
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mantel rectangular',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mantel rectangular',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Mantel rectangular',
			'type'=>'blanco'
		]);
		// ------------------------Cubre mantel rectangular
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre mantel rectangular',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre mantel rectangular',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre mantel rectangular',
			'type'=>'blanco'
		]);
		// -----------------Fundas francesas
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Fundas francesas',
			'type'=>'uno'
		]);
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Fundas francesas',
			'type'=>'dos'
		]);
		// ----------------------Moños		
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Moños',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Moños',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Moños',
			'type'=>'blanco'
		]);
		// ---------------------Cubre respaldos
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre respaldos',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre respaldos',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Cubre respaldos',
			'type'=>'blanco'
		]);		
		// ---------------------Servilleta de tela
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Servilleta de tela',
			'type'=>'verde'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Servilleta de tela',
			'type'=>'azul'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Servilleta de tela',
			'type'=>'blanco'
		]);	
		//------------------------------Bambalinas 
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Bambalinas',
			'type'=>'Cuadradas'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Bambalinas',
			'type'=>'Rectangulares'
		]);	
		// -----------------------------Platos base
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Platos base',
			'type'=>'redondos'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Platos base',
			'type'=>'cuadrados'
		]);	
		// ------------------------------Platos postre
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Platos postre',
			'type'=>'redondos'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Platos postre',
			'type'=>'cuadrados'
		]);	
		// ------------------------------Platos entremes
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Platos entremes',
			'type'=>'redondos'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Platos entremes',
			'type'=>'cuadrados'
		]);	
		// -----------------------------Tazón
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Tazón',
			'type'=>'Chico'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Tazón',
			'type'=>'Mediano'
		]);	

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Tazón',
			'type'=>'Grande'
		]);	
		// -----------------------------Vasos
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Vasos',
			'type'=>'High ball'
		]);

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Vasos',
			'type'=>'Cubero'
		]);	

		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Vasos',
			'type'=>'Chaiser'
		]);	
		Product::create([
			'rental_price'=>'123',
			'grupo'=>'Vasos',
			'type'=>'old fashion'
		]);	
	}
}