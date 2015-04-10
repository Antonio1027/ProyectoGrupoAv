<?php 

use Grupoav\Repositories\ProductRepo;

class ProductController extends BaseController
{
	protected $productRepo;

	function __construct(ProductRepo $productRepo)
	{
		$this->productRepo = $productRepo;
	}
	
	public function products(){
		$products = $this->productRepo->products();
		return Response::json($products);
		dd($products);
	}
}

 ?>