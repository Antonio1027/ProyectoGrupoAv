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
		if($categories->count())
			return Response::json($categories,200);
		return Response::json(array('errors' => array('msg'=>array('No se encotraron resultados'))),422);//solicitud no procesada
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

			$datageneral['subtotal'] = number_format($datageneral['subtotal'], 2, '.', '');
			$datageneral['total'] = number_format($datageneral['total'], 2, '.', '');
			$datageneral['balance'] = number_format($datageneral['balance'], 2, '.', '');
			$datageneral['deposit'] = number_format($datageneral['deposit'], 2, '.', '');
			$datageneral['discount'] = number_format($datageneral['discount'], 2, '.', '');
			$datageneral['advanced_payment'] = number_format($datageneral['advanced_payment'], 2, '.', '');
			
			unset($datageneral['types']);
			$data = array('CPT'=>$categories,'datageneral'=>$datageneral);	

			return Response::json($data,200);
		}
		return Response::json(array('errors'=>array('msg'=>array('Presupuesto no encontrado'))),422);
	}
}

?>