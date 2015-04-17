<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Product;
use Grupoav\Entities\Category;

class ProductRepo extends \Eloquent
{
	public function newProduct(){
		$product = new Product();
		return $product;
	}
	public function getListProduct($category_id){
		$listProduct = Product::where('category_id','=',$category_id)
								->get(array('id','name'));
		return $listProduct;
	}
}


 ?>