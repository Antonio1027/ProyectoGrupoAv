<?php 

use Grupoav\Repositories\UserRepo;
use Grupoav\Repositories\CategoryRepo;
use Grupoav\Repositories\ProductRepo;
use Grupoav\Repositories\EstimationRepo;
use Grupoav\Repositories\TypeRepo;

use Grupoav\Managers\UpdateUser;
use Grupoav\Managers\NewCategory;
use Grupoav\Managers\NewProduct;
use Grupoav\Managers\NewType;
use Grupoav\Managers\NewEstimation;
// use Grupoav\Managers\UpdateEstimation;

class UpdateController extends BaseController
{
	
	protected $userRepo,$categoryRepo,$productRepo,$estimationRepo,$typeRepo;

	function __construct(UserRepo $userRepo, CategoryRepo $categoryRepo,
						 ProductRepo $productRepo, EstimationRepo $estimationRepo,
						 TypeRepo $typeRepo)
	{
		$this->userRepo = $userRepo;	
		$this->categoryRepo = $categoryRepo;	
		$this->productRepo = $productRepo;	
		$this->estimationRepo = $estimationRepo;		
		$this->typeRepo = $typeRepo;	
	}

	public function updateUser(){
		$data = Input::all();
		$user = $this->userRepo->findUser($data['id']);
		$manager = new UpdateUser($user,$data);
		if($manager->save())
			return Response::json(array('success' => array('msg'=>array('Has actualizado la información del usuario'))),201);//recurso creado			
		return Response::json(array('errors' => $manager->getErrors()),422);//solicitud no procesada
	}

	public function updateCategory(){
		$data = Input::all();		
		$category = $this->categoryRepo->findCategory($data['id']);
		$manager = new NewCategory($category,$data);
		if($manager->save())
			return Response::json(array('success' => array('msg'=>array('Has actualizado la información de la categoria'))),201);//recurso creado			
		return Response::json(array('errors' => $manager->getErrors()),422);//solicitud no procesada	
	}

	public function updateProduct(){
		$data = Input::all();
		$product = $this->productRepo->findProduct($data['id']);
		$manager = new NewProduct($product,$data);
		if($manager->save())
			return Response::json(array('success' => array('msg'=>array('Has actualizado la información del producto'))),201);//recurso creado			
		return Response::json(array('errors' => $manager->getErrors()),422);//solicitud no procesada		
	}	

	public function updateType(){
		$data = Input::all();
		$type = $this->typeRepo->findType($data['id']);
		$manager = new NewType($type,$data);
		if($manager->save())
			return Response::json(array('success' => array('msg'=>array('Has actualizado la información del tipo de producto'))),201);//recurso creado			
		return Response::json(array('errors' => $manager->getErrors()),422);//solicitud no procesada		
	}	
	public function updateEstimation(){
		$data = Input::all();
		$dataEstimation = $data[0];					

		if(! isset($data[1]) || empty($data[1]))
			return Response::json(array('errors' => array('msg'=>array('Debe seleccionar al menos un articulo'))),422);//solicitud no procesada

		$estimation = $this->estimationRepo->findEstimation($dataEstimation['id']);
		$manager = new NewEstimation($estimation,$dataEstimation);
		if($manager->save())
		try {			
			$newtypes = array();
			$status = false;
			foreach ($estimation->types as $key => $type) {
				foreach ($data[1] as $key => $value) {				
					if((int)$type->id == (int)$value['id']){
						$status = true;
						break;
					}	
					else
						$status = false;
				}
				if(! $status)
					$estimation->types()->detach($type->id);			
				$status = false;
			}				
			$aux = false;
			foreach ($data[1] as $index => $value) {
				foreach ($estimation->types as $key => $type){
					if((int)$value['id'] == (int)$type->id){
						if((int)$type->pivot->quantity != (int)$value['quantity']){
							$attributes = array('quantity' => (int)$value['quantity']);
							$estimation->types()->updateExistingPivot($type->id,$attributes);
						}					
						unset($data[1][$index]);
						unset($estimation->types[$key]);
						$aux = true;
						break;
					}
					else{			
						$aux = false;
					}								
				}
				if(! $aux){
					$newtypes[$index]['id'] = $value['id'];
					$newtypes[$index]['quantity'] = $value['quantity'];				
				}
				$aux = false;
			}			
			if(count($newtypes)){
				$estimation->types()->attach($this->renameIndex($newtypes));			
			}
			return Response::json(array('success' => array('msg'=>array('Has actualizado el presupuesto correctamente'))),201);//recurso creado						
		} catch (Exception $e) {			
			return Response::json(array('errors' => array('msg'=>array('Ocurrio un error intente más tarde'))),422);//solicitud no procesada
		}
		
	}
}

?>