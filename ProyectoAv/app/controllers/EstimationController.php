<?php 

use Grupoav\Repositories\EstimationRepo;

class EstimationController extends BaseController
{	
	protected $estimationRepo;

	function __construct(EstimationRepo $estimationRepo)
	{
		$this->estimationRepo = $estimationRepo;
	}

	public function getEstimations(){
		$estimations = $this->estimationRepo->allEstimations();
		if($estimations->count())
			return Response::json(array("data" => $estimations),200);
		return Response::json(array('errors'=>array('msg'=>array('No se encontraron resultados'))),422);
	}
}

?>