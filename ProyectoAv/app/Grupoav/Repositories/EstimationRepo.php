<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Estimation;

class EstimationRepo extends \Eloquent
{
	public function newEstimation(){
		$estimation = new Estimation();
		return $estimation;
	}
}

?>
