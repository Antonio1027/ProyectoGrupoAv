<?php 

use Grupoav\Repositories\CategoryRepo;

class CategoryController extends BaseController
{
	protected $categoryRepo;

	function __construct(CategoryRepo $categoryRepo)
	{
		$this->categoryRepo = $categoryRepo;
	}

	public function categories(){
		$categories = $this->categoryRepo->allCategories();
		return Response::json($categories);
	}	
}

?>