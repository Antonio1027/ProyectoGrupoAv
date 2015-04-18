<?php 

use Grupoav\Repositories\UserRepo;
use Grupoav\Repositories\CategoryRepo;
use Grupoav\Repositories\ProductRepo;
use Grupoav\Repositories\EstimationRepo;
use Grupoav\Repositories\TypeRepo;

class DeleteController extends BaseController
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

	public function deleteUser($idUser){		
		if($idUser > 0){		
			return Response::json(array('success' => array('msg'=>array('Has eliminado un usuario'))));//solicitud procesad== 1	
		}	
		return Response::json(array('errors' => array('msg'=>array('Ocurrio un error al eliminar el usuario'))));//solicitud no procesada
	}
	
	public function deleteCategory($idCategory){			
		if($idCategory > 0)
			return Response::json(array('success' => array('msg'=>array('Has eliminado una categoria'))),200);//solicitud procesada			
		return Response::json(array('errors' => array('msg'=>array('Ocurrio un error al eliminar la categoria'))),422);//solicitud no procesada
	}
	public function deleteProduct($idProduct){		
		if($idProduct > 0)
			return Response::json(array('success' => array('msg'=>array('Has eliminado un producto'))),200);//solicitud procesada			
		return Response::json(array('errors' => array('msg'=>array('Ocurrio un error al eliminar el producto'))),422);//solicitud no procesada
	}
	public function deleteEstimation($idEstimation){		
		if($idEstimation > 0)
			return Response::json(array('success' => array('msg'=>array('Has eliminado un presupuesto'))),200);//solicitud procesada			
		return Response::json(array('errors' => array('msg'=>array('Ocurrio un error al eliminar el presupuesto'))),422);//solicitud no procesada
	}
	public function deleteType($idType){		
		if($idType > 0)
			return Response::json(array('success' => array('msg'=>array('Has eliminado un tipo de producto'))),200);//solicitud procesada			
		return Response::json(array('errors' => array('msg'=>array('Ocurrio un error al eliminar el tipo de producto'))),422);//solicitud no procesada
	}

}

?>