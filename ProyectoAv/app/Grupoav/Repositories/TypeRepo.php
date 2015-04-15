<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Type;

class TypeRepo extends \Eloquent
{
	public function newType(){
		$type = new Type();
		return $type;
	}
}

?>