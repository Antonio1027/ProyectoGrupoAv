<?php 

namespace Grupoav\Managers;

class NewCategory extends BaseManager
{
	public function getRules(){
		$rules = array('name' => 'required');
		return $rules;
	}
}

?>