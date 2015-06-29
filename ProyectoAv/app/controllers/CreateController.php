<?php 

use Grupoav\Repositories\UserRepo;
use Grupoav\Repositories\CategoryRepo;
use Grupoav\Repositories\ProductRepo;
use Grupoav\Repositories\EstimationRepo;
use Grupoav\Repositories\TypeRepo;
use Grupoav\Repositories\OrderRepo;

use Grupoav\Managers\NewUser;
use Grupoav\Managers\NewCategory;
use Grupoav\Managers\NewProduct;
use Grupoav\Managers\NewEstimation;
use Grupoav\Managers\NewType;
use Grupoav\Managers\NewPayment;


class CreateController extends BaseController
{
	protected $userRepo,$categoryRepo,$productRepo,$estimationRepo,$typeRepo,$orderRepo;

	function __construct(UserRepo $userRepo, CategoryRepo $categoryRepo,
						 ProductRepo $productRepo, EstimationRepo $estimationRepo,
						 TypeRepo $typeRepo, OrderRepo $orderRepo)
	{		
		$this->userRepo = $userRepo;
		$this->categoryRepo = $categoryRepo;
		$this->productRepo = $productRepo;
		$this->estimationRepo = $estimationRepo;
		$this->typeRepo = $typeRepo;
		$this->orderRepo = $orderRepo;
	}

	public function newUser(){
		$data = Input::all();		
		$user = $this->userRepo->newUser();		

		$manager = new NewUser($user,$data);

		if($manager->save())
			return Response::json(array('success' => array('msg'=>array('Has agregado un usuario correctamente')),'user'=>$manager->entity),201);//recurso creado			
		return Response::json(array('errors' => $manager->getErrors()),422);//solicitud no procesada
	}

	public function newCategory(){
		$data = Input::all();
		$category = $this->categoryRepo->newCategory();		
		$manager = new NewCategory($category,$data);		
		if($manager->save())			
			return Response::json(array('success' => array('msg'=>array('Has agregado una categoria correctamente')),
								        'data'=>array('id'=>$manager->entity->id,
								        			  'name'=> $manager->entity->name)),201);			
		return Response::json(array('errors' => $manager->getErrors()),422);
	}

	public function newProduct(){
		$data = Input::all();		
		$product = $this->productRepo->newProduct();
		$manager = new NewProduct($product,$data);
		if($manager->save())			
			return Response::json(array('success' => array('msg'=>array('Has agregado un producto correctamente')),
								        'data'=>array('id'=>$manager->entity->id,
								        			  'name'=> $manager->entity->name,
								        			  'category_id'=> $manager->entity->category_id)),201);
		return Response::json(array('errors' => $manager->getErrors()),422);
	}	

	public function newEstimation(){		
		$data = Input::all();
		$dataEstimation = $data[0];
		$dataType = $data[1];				

		if(! isset($data[1]) || empty($data[1]))
			return Response::json(array('errors'=>array('msg'=>array('Debe seleccionar al menos un producto'))),422);

		$estimation = $this->estimationRepo->newEstimation();
		$manager = new NewEstimation($estimation,$dataEstimation);			

		if($this->validate($dataType))			
			if($manager->save() && $manager->entity->types()->sync($this->renameIndex($dataType))){									
				return Response::json(array('success' => array('msg'=>array('Has creado un presupuesto correctamente'),'id' => $manager->entity->id)),201);//recurso creado					
			}
			else		
				return Response::json(array('errors' => $manager->getErrors()),422);
		else
			return Response::json(array('errors'=>array('msg'=>array('Verfique que no sobrepase la reserva de un artículo'))),422);			
	}

	public function discountProducts($types){		
		$status = true;	
		foreach ($types as $key => $data) {
			$type = $this->typeRepo->findType($data['id']);			
			$type->reserve = $type->reserve - (int)$data['pivot']['quantity'];			
			if($type->reserve > 0)
				$type->save();			
			else{
				$status = false;
				break;				
			}
		}
		return $status;		
	}

	public function validate($types){		

		$status = true;		
		foreach ($types as $key => $data) {
			$type = $this->typeRepo->findType($data['id']);
			$type->reserve = $type->reserve - (int)$data['quantity'];
			if($type->reserve > 0)
				$status = true;
			else{
				$status = false;
				break;				
			}
		}
		return $status;
	}

	public function newType(){
		$data = Input::all();
		$type = $this->typeRepo->newType();		
		$manager = new NewType($type,$data);
		if($manager->save())
			return Response::json(array('success' => array('msg'=>array('Has agregado un tipo de producto correctamente')),
										'data'=>array('id'=>$manager->entity->id,
								        			  'name'=> $manager->entity->name,
								        			  'category_id'=> $manager->entity->product_id)),201);//recurso creado	
		return Response::json(array('errors' => $manager->getErrors()),422);	
	}

	public function confirmEstimation(){
		$estimation = $this->estimationRepo->findEstimation(Input::get('id'));
		if($estimation){
			if(!$estimation->order){
				$order = $this->orderRepo->newOrder(Input::get('id'));
				if($order->save()){
					$data = array(	'amount' 		=> $estimation->advanced_payment,
									'description' 	=> 'Primer anticipo',
									'order_id'		=> $order->id,
									'anticipo'		=> true);												
					if($this->discountProducts($estimation->types->toArray()) && $this->newPayment($data)){

						return Response::json(array('success'=>array('id'=>$order->id)),201);
					}	
					else{				
						return Response::json(array('errors'=>array('msg'=>array('Verfique que no sobrepase la reserva de un artículo'))),422);		
					}
				}	
			}
			else
				return Response::json(array('errors'=>array('msg'=>array('Ya ha sido elaborada una orden con este presupuesto'))),422);
		}
		return Response::json(array('errors'=>array('msg'=>array('No se encontraron resultados'))),422);
	}

	public function newPayment($values = []){

		if((int)$values['amount'] <= 0)
			return true;

		if(count($values)){
			$data = $values;
			$status = $data['anticipo'];
			unset($data['anticipo']);
		}
		else
			$data = Input::all();		

		$payment = $this->orderRepo->newPayment((int)$data['order_id']);

		$manager = new NewPayment($payment,$data);

		if($manager->save())
			if(isset($status))
				return true;
			else	
				return Response::json(array('success'=>array('msg'=>array('Ha registrado un pago correctamente'))),201);
		else 
			return Response::json(array('errors' => $manager->getErrors()),422);
	}	
}

?>