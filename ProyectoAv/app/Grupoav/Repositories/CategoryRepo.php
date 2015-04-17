<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Category;

class CategoryRepo extends \Eloquent
{
	public function newCategory(){
		$category = new Category();
		return $category;
	}

	public function allCategories(){
		return Category::with('listproducts.types')->get();
	}

	public function listCategory(){
		return Category::lists('name','id');
	}
}

?>