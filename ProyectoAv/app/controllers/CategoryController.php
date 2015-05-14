<?php 

use Grupoav\Repositories\CategoryRepo;
use Grupoav\Repositories\EstimationRepo;

class CategoryController extends BaseController
{
	protected $categoryRepo;

	function __construct(CategoryRepo $categoryRepo, EstimationRepo $estimationRepo)
	{
		$this->categoryRepo = $categoryRepo;
		$this->estimationRepo = $estimationRepo;
	}

	public function categories(){
		$categories = $this->categoryRepo->allCategories();		
		return Response::json($categories,200);
	}		
	public function getupdateEstimation($id){
		$categories = $this->categoryRepo->allCategories();
		$estimation = $this->estimationRepo->findEstimation($id);		
		$types = $estimation->types->toArray();			
		if($estimation){	
			foreach ($types as $index => $type) {		
				foreach ($categories as $key1 => $categorie) {
					foreach ($categorie->listproducts as $key2 => $product) {
						foreach ($product->types as $key3 => $value) {																															
							if($type['id'] == $value->id){								
								$value->show = true;	
								$value->quantity = $type['pivot']['quantity'];
							}
						}
					}
				}			
			}
			$datageneral = $estimation->toArray();					
			unset($datageneral['types']);
			$data = array('CPT'=>$categories,'datageneral'=>$datageneral);	

			return Response::json($data,200);
		}
		return 	Response::json(array('errors'=>array('msg'=>'Presupuesto no encontrado')),422);
	}
}

?>