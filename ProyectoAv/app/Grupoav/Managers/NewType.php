<?php 

namespace Grupoav\Managers;

class NewType extends BaseManager
{
	public function getRules(){
		$rules = array('name' => 'required',
					   'product_id' => 'required');
		return $rules;
	}	
}

?>