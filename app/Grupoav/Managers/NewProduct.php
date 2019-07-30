<?php 

namespace Grupoav\Managers;

class NewProduct extends BaseManager
{
	public function getRules(){
		$rules = array('name' => 'required',					   
					   'category_id' => 'required');
		return $rules;
	}	
}

?>
