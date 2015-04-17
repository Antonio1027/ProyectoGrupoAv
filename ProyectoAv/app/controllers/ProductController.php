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
	}
	public function getListProduct($idcategory){
		$listProducts = $this->productRepo->getListProduct($idcategory);		
		if($listProducts->count())
			return Response::json($listProducts,200);
		return Response::json(array('errors'=>array('msg'=>array('No se encontraron resultados'))),422);
	}
}

 ?>