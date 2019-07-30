<?php 

namespace Grupoav\Repositories;
use Grupoav\Entities\Type;
use Grupoav\Entities\Extratype;

class TypeRepo extends \Eloquent
{
	public function newType(){
		$type = new Type();
		return $type;
	}

	public function findType($id){
		return Type::find($id);
	}

	public function findExtratype($id){
		return Extratype::find($id);
	}
}

?>