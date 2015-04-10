<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Product;

class ProductRepo extends \Eloquent
{
	public function products(){
		$products = array();
		$groups = Product::distinct()->get(array('grupo'));		
		foreach ($groups as $key => $group) {		
			$products[$group->grupo] = Product::where('grupo','=',$group->grupo)->lists('type','id');
		}
		return $products;
	}
}


 ?>