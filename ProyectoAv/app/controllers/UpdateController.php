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
}

?>