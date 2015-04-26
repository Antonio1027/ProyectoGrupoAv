<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Estimation;
use Grupoav\Entities\Type;

class EstimationRepo extends \Eloquent
{
	public function newEstimation(){
		$estimation = new Estimation();
		return $estimation;
	}

	public function allEstimations(){
		return Estimation::all();
	}

	public function findEstimation($id){		
		$estimation = Estimation::find($id);		
		return $estimation;
	}
}

?>
