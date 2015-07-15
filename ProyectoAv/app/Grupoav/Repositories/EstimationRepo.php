<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Estimation;
use Grupoav\Entities\Type;
use Grupoav\Entities\Extratype;

class EstimationRepo extends \Eloquent
{
	public function newEstimation(){
		$estimation = new Estimation();
		return $estimation;
	}

	public function allEstimations(){
		return Estimation::has('order','=',0)->get();
	}

	public function findEstimation($id){		
		$estimation = Estimation::find($id);		
		return $estimation;
	}	

	public function newExtratype(){
		$extratype = new Extratype();
		return $extratype;
	}
}

?>
