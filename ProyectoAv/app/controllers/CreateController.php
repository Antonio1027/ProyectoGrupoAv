<?php 

use Grupoav\Repositories\UserRepo;
use Grupoav\Repositories\CategoryRepo;
use Grupoav\Repositories\ProductRepo;
use Grupoav\Repositories\EstimationRepo;
use Grupoav\Repositories\TypeRepo;

use Grupoav\Managers\NewUser;
use Grupoav\Managers\NewCategory;
use Grupoav\Managers\NewProduct;
use Grupoav\Managers\NewEstimation;
use Grupoav\Managers\NewType;

class CreateController extends BaseController
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

	public function newUser(){
		$data = Input::all();		
		$user = $this->userRepo->newUser();
		$manager = new NewUser($user,$data);
		if($manager->save())
			return Response::json(array('msg' => 'Usuario registrado'),201);//recurso creado
		return Response::json(array('errors' => $manager->getErrors()),422);//solicitud no procesada
	}

	public function newCategory(){
		$data = Input::all();
		$category = $this->categoryRepo->newCategory();		
		$manager = new NewCategory($category,$data);		
		if($manager->save())			
			return Response::json(array('msg' => 'Categoria registrada',
										'name'=>$manager->entity->name,
										'id'=>$manager->entity->id),201);
		
		return Response::json(array('errors' => $manager->getErrors()),422);
	}

	public function newProduct(){
		$data = Input::all();		
		$product = $this->productRepo->newProduct();
		$manager = new NewProduct($product,$data);
		if($manager->save())			
			return Response::json(array('msg' => 'Producto registrado'),201);
		return Response::json(array('errors' => $manager->getErrors()),422);
	}	

	public function newEstimation(){
		$data = Input::all();
		// if(! $data['products'])
		// 	return Response::json(array('errors' =>'Debe seleccionar al menos un producto'),422);
		$estimation = $this->estimationRepo->newEstimation();
		$manager = new NewEstimation($estimation,$data);	
		if($manager->save()){
			return Response::json(array('msg' => 'Presupuesto registrado'),201);
		}
		return Response::json(array('errors' => $manager->getErrors()),422);
	}

	public function newType(){
		$data = Input::all();
		$type = $this->typeRepo->newType();		
		$manager = new NewType($type,$data);
		if($manager->save())
			return Response::json(array('msg' => 'Tipo registrado'),201);
		return Response::json(array('errors' => $manager->getErrors()),422);	
	}
}

?>