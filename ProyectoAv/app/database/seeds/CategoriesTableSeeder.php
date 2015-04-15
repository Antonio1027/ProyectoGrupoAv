<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Grupoav\Entities\Category;
use Grupoav\Entities\Product;
use Grupoav\Entities\Type;

use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$categories = array('carpas',
							'mesas',
							'sillas',
							'manteles',
							'platos',
							'servilletas',
							'bambalinas',
							'personal',
							'copas',
							'alimentos',
							'cubremanteles',
							'fundas');

		$products = array(
						array('sencilla','arabe'),//CARPAS
						array('periquera','honor'),//MESAS
						array('acojinadas','metalicas'),//SILLAS
						array('redondos','rectangulares'),//MANTELES
						array('base','postre'),//PLATOS
						array('tela'),//SERVILLETAS
						array('rectangulares','cuadradas'),//BAMBALINAS
						array('capitan','mesero'),//PERSONAL
						array('flauta','champagne baja'),//COPAS
						array('uno','dos'),//ALIMENTOS
						array('cuadrado','rectangular'),//CUBREMANTELES
						array('francesas','cubre respaldos')//FUNDAS
					);
		$types = array(
					array('4 x 2','4 x 4'),array('uno','dos'),
					array('uno','dos'),array('uno','dos'),
					array('uno,dos'),array('uno','dos'),
					array('verde','azul'),array('verde','azul'),
					array('redondo','cuadrado'),array('redondo','cuadrado'),
					array('verde','azul'),
					array('verde','azul'),array('verde','azul'),
					array(),array(),
					array(),array(),
					array('uno','dos'),array('uno','dos'),
					array('uno','dos'),array('uno','dos')
				);

		foreach($categories as $key => $category)
		{
			$field = Category::create([
				'name'	=> $category
			]);
			foreach ($products[$key] as $key2 => $product) {
				$field_product = Product::create([
					'name'			=> $product,
					'rental_price'	=> '1200',
					'reserve'		=> '0',
					'total'			=> '200',
					'category_id'	=> $field->id
				]);
				foreach ($types[$key2] as $type) {
					Type::create([
						'name'	=> $type,
						'product_id'	=> $field_product->id
					]);
				}
			}
		}
	}

}